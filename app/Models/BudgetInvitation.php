<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\BudgetInvitation
 *
 * @property int $id
 * @property string $ulid
 * @property string $token
 * @property string $name
 * @property string|null $nickname
 * @property string|null $email
 * @property Carbon $expires_at
 * @property string $state
 * @property int|null $budget_id
 * @property int|null $sender_id
 * @property Carbon|null $sent_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Budget|null $budget
 * @property-read User|null $sender
 * @method static \Database\Factories\BudgetInvitationFactory factory($count = null, $state = [])
 * @method static Builder|BudgetInvitation newModelQuery()
 * @method static Builder|BudgetInvitation newQuery()
 * @method static Builder|BudgetInvitation query()
 * @method static Builder|BudgetInvitation whereBudgetId($value)
 * @method static Builder|BudgetInvitation whereCreatedAt($value)
 * @method static Builder|BudgetInvitation whereEmail($value)
 * @method static Builder|BudgetInvitation whereExpiresAt($value)
 * @method static Builder|BudgetInvitation whereId($value)
 * @method static Builder|BudgetInvitation whereName($value)
 * @method static Builder|BudgetInvitation whereNickname($value)
 * @method static Builder|BudgetInvitation whereSenderId($value)
 * @method static Builder|BudgetInvitation whereSentAt($value)
 * @method static Builder|BudgetInvitation whereState($value)
 * @method static Builder|BudgetInvitation whereToken($value)
 * @method static Builder|BudgetInvitation whereUlid($value)
 * @method static Builder|BudgetInvitation whereUpdatedAt($value)
 * @property string|null $role
 * @method static Builder|BudgetInvitation pending()
 * @method static Builder|BudgetInvitation whereRole($value)
 * @mixin \Eloquent
 */
class BudgetInvitation extends Model
{
    use HasFactory, HasUlids, Prunable;

    const STATE_ACCEPTED = 'accepted';

    const STATE_EXPIRED = 'expired';

    const STATE_PENDING = 'pending';

    const STATE_REJECTED = 'rejected';

    const STATE_FAILED = 'failed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ulid',
        'token',
        'name',
        'nickname',
        'email',
        'role',
        'expires_at',
        'state',
        'budget_id',
        'sender_id',
        'sent_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'expires_at' => 'datetime',
        'budget_id' => 'integer',
        'sender_id' => 'integer',
        'sent_at' => 'datetime',
    ];

    /*
    |----------------------------------
    | Model Configuration
    |----------------------------------
    */
    public static function booted(): void
    {
        static::creating(function (BudgetInvitation $invitation) {
            if (! $invitation->token) {
                $invitation->token = self::generateToken();
                $invitation->expires_at = now()->addDays(7);
            }
        });
    }

    public static function generateToken(): string
    {
        return Str::random(32);
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public function prunable(): Builder
    {
        return static::where('expires_at', '<=', now());
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Scopes
    |----------------------------------
    */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('state', self::STATE_PENDING);
    }

    /*
    |----------------------------------
    | Affordances, Helpers, etc.
    |----------------------------------
    */
    public function failedToSend(): bool
    {
        return $this->state === self::STATE_FAILED;
    }

    public function isAccepted(): bool
    {
        return $this->state === self::STATE_ACCEPTED;
    }

    public function isExpired(): bool
    {
        return $this->state === self::STATE_EXPIRED || $this->expires_at->isPast();
    }

    public function isPending(): bool
    {
        return $this->state === self::STATE_PENDING;
    }

    public function isRejected(): bool
    {
        return $this->state === self::STATE_REJECTED;
    }

    public function markAsAccepted(): void
    {
        $this->update([
            'state' => self::STATE_ACCEPTED,
        ]);
    }

    public function markAsExpired(): void
    {
        $this->update([
            'state' => self::STATE_EXPIRED,
        ]);
    }

    public function markAsFailed(): void
    {
        $this->update([
            'state' => self::STATE_FAILED,
        ]);
    }

    public function markAsPending(): void
    {
        $this->update([
            'state' => self::STATE_PENDING,
        ]);
    }

    public function markAsRejected(): void
    {
        $this->update([
            'state' => self::STATE_REJECTED,
        ]);
    }

    public function markAsSent($time = null): void
    {
        $this->update([
            'sent_at' => Carbon::parse($time ?? now()),
        ]);
    }

    /*
    |----------------------------------
    | Relationships
    |----------------------------------
    */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
