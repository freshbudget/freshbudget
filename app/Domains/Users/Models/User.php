<?php

namespace App\Domains\Users\Models;

use App\Domains\Budgets\Actions\CreateBudgetAction;
use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Users\Actions\AcceptBudgetInvitationAction;
use App\Domains\Users\Actions\SwitchCurrentBudgetAction;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, HasUlids, Notifiable;

    /**
     * A flag to indicate the user self registered with the application. This is the default registration source.
     * In the future, this may be used to determine how many users are self registered vs invited.
     */
    const SELF_REGISTERED = 'self-registration';

    /**
     * A flag to indicate the user registered via an invitation.
     * In the future, this may be used to determine how many users are self registered vs invited.
     */
    const REGISTERED_VIA_INVITATION = 'registered-via-invitation';

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
        'registration_source',
        'finished_onboarding',
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
        'finished_onboarding' => 'boolean',
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    protected static function booted(): void
    {
        static::created(function (User $user) {
            $budget = app(CreateBudgetAction::class)->execute($user, [
                'name' => 'Personal Budget',
                'personal' => true,
            ]);

            $user->update(['current_budget_id' => $budget->id]);
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
    public function getAvatarAttribute(): string
    {
        return 'https://ui-avatars.com/api/?name='.
            urlencode(str()->ascii($this->displayName)).
            '&color=c084fc&background=cbd5e1';
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->nickname ?? $this->name;
    }

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function currentBudget(): BelongsTo
    {
        if (is_null($this->current_budget_id) && $this->id) {
            $this->switchCurrentBudget($this->personalBudget());
        }

        return $this->belongsTo(Budget::class, 'current_budget_id');
    }

    public function joinedBudgets(): BelongsToMany
    {
        return $this->belongsToMany(Budget::class, 'budget_users')->withTimestamps();
    }

    public function ownedBudgets(): HasMany
    {
        return $this->hasMany(Budget::class, 'owner_id');
    }

    public function personalBudget(): Budget
    {
        return $this->joinedBudgets()->where('personal', true)->first();
    }

    /*
    |----------------------------------
    | Two Factor Authentication
    |----------------------------------
    */
    public function twoFactorAuthEnabledAndConfirmed(): bool
    {
        return $this->two_factor_enabled &&
            ! is_null($this->two_factor_confirmed_at);
    }

    /*
    |--------------------------------------------------------------------------
    | Budget (Team) Functionality
    |--------------------------------------------------------------------------
    */
    public function acceptBudgetInvitation(BudgetInvitation $invitation): void
    {
        app(AcceptBudgetInvitationAction::class)->execute($this, $invitation);
    }

    public function belongsToBudget(Budget $budget): bool
    {
        return $this->ownsBudget($budget) || $budget->hasMember($this);
    }

    public function currentBudgetIs(Budget $budget): bool
    {
        return $budget->id === $this->currentBudget->id;
    }

    public function ownsBudget(Budget $budget): bool
    {
        return $this->id === $budget->owner_id;
    }

    public function switchCurrentBudget(Budget $budget): bool
    {
        return (bool) app(SwitchCurrentBudgetAction::class)->execute($this, $budget);
    }
}
