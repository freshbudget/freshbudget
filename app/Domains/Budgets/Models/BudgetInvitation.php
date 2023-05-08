<?php

namespace App\Domains\Budgets\Models;

use Database\Factories\BudgetInvitationFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BudgetInvitation extends Model
{
    use HasFactory, HasUlids;

    const STATE_ACCEPTED = 'accepted';

    const STATE_EXPIRED = 'expired';

    const STATE_PENDING = 'pending';

    const STATE_REJECTED = 'rejected';

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
        'expires_at',
        'state',
        'budget_id',
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
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }

    public static function newFactory()
    {
        return BudgetInvitationFactory::new();
    }

    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    /*
    |----------------------------------
    | Affordances, Helpers, etc.
    |----------------------------------
    */
    public static function generateToken(): string
    {
        return Str::random(32);
    }

    public function isAccepted(): bool
    {
        return $this->state === self::STATE_ACCEPTED;
    }

    public function isExpired(): bool
    {
        return $this->state === self::STATE_EXPIRED;
    }

    public function isPending(): bool
    {
        return $this->state === self::STATE_PENDING;
    }

    public function isRejected(): bool
    {
        return $this->state === self::STATE_REJECTED;
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
}
