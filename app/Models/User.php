<?php

namespace App\Models;

use App\Actions\User\AcceptBudgetInvitationAction;
use App\Actions\User\SwitchCurrentBudgetAction;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string|null $nickname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property bool $two_factor_enabled
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null $two_factor_confirmed_at
 * @property int|null $current_budget_id
 * @property string|null $registration_source
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Budget|null $currentBudget
 * @property-read string $avatar
 * @property-read string $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Budget> $joinedBudgets
 * @property-read int|null $joined_budgets_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Budget> $ownedBudgets
 * @property-read int|null $owned_budgets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 *
 * @property bool $finished_onboarding
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFinishedOnboarding($value)
 *
 * @mixin \Eloquent
 */
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

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'two_factor_confirmed_at' => 'datetime',
        'current_budget_id' => 'integer',
        'finished_onboarding' => 'boolean',
    ];

    /*
    |-----------------------------------------
    | Model Configuration
    |-----------------------------------------
    */
    protected static function booted(): void
    {
        static::created(function (User $user) {
            $budget = $user->ownedBudgets()->create([
                'name' => 'Personal Budget',
                'currency' => 'USD',
                'personal' => true,
            ]);

            $user->update(['current_budget_id' => $budget->id]);
        });
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |-----------------------------------------
    | Accessors, Mutators, Scopes, etc.
    |-----------------------------------------
    */
    public function getDisplayNameAttribute(): string
    {
        return $this->nickname ?? $this->name;
    }

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /*
    |-----------------------------------------
    | Relationships
    |-----------------------------------------
    */
    public function currentBudget(): BelongsTo
    {
        if (is_null($this->current_budget_id)) {
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
    |-----------------------------------------
    | Budget (Team) Functionality
    |-----------------------------------------
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
