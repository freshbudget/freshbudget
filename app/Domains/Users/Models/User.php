<?php

namespace App\Domains\Users\Models;

use App\Domains\Budgets\Actions\CreateBudgetAction;
use App\Domains\Budgets\Models\Budget;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'two_factor_enabled',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'current_budget_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'two_factor_confirmed_at' => 'datetime',
        'current_budget_id' => 'integer',
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    protected static function booted(): void
    {
        static::created(function (User $user) {
            app(CreateBudgetAction::class)->execute([
                'name' => 'Personal Budget',
                'personal' => true,
            ], $user);
        });
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public static function newFactory()
    {
        return UserFactory::new();
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Accessors, Mutators, Scopes, etc.
    |----------------------------------
    */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'owner_id');
    }

    /*
    |----------------------------------
    | Two Factor Authentication
    |----------------------------------
    */
    public function twoFactorAuthEnabledAndConfirmed(): bool
    {
        return $this->two_factor_enabled;
    }

    /*
    |--------------------------------------------------------------------------
    | Team Budget Functionality
    |--------------------------------------------------------------------------
    */
    public function belongsToBudget(Budget $budget): bool
    {
        return $this->ownsBudget($budget) ||
            $this->budgets->contains($budget->team);
    }

    public function currentBudget(): BelongsTo
    {
        if (is_null($this->current_budget_id) && $this->id) {
            $this->switchCurrentBudget($this->personalBudget());
        }

        return $this->belongsTo(Budget::class, 'current_budget_id');
    }

    public function isCurrentBudget(Budget $budget): bool
    {
        return $budget->id === $this->currentBudget->id;
    }

    public function ownedBudgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'owner_id');
    }

    public function ownsBudget(Budget $budget): bool
    {
        return $this->id === $budget->owner_id;
    }

    public function personalBudget(): Budget
    {
        return $this->budgets()->where('personal', true)->first();
    }

    public function switchCurrentBudget(Budget $budget): bool
    {
        if (! $this->belongsToBudget($budget)) {
            return false;
        }

        $this->forceFill([
            'current_budget_id' => $budget->id,
        ])->save();

        $this->setRelation('currentBudget', $budget);

        return true;
    }
}
