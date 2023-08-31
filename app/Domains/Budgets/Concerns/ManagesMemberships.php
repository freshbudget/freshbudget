<?php

namespace App\Domains\Budgets\Concerns;

use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ManagesMemberships
{
    /*
    |----------------------------------
    | Members
    |----------------------------------
    */
    public function addMember(User $user): void
    {
        $this->members()->attach($user->id);
    }

    public function hasCurrentMembers(User $exclude = null): bool
    {
        return $this->members()
            ->where('current_budget_id', $this->id)
            ->when($exclude, function ($query, $user) {
                $query->where('user_id', '!=', $user->id);
            })->exists();
    }

    public function hasMemberWithEmail(string $email): bool
    {
        return $this->members()->where('email', $email)->exists();
    }

    public function hasMember(User $user): bool
    {
        return $this->members->contains($user) || $this->owner->is($user);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->owner->is($user);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'budget_users', 'budget_id', 'user_id')->withTimestamps();
    }

    public function removeMember(User $user): void
    {
        $this->members()->detach($user->id);
    }

    /*
    |----------------------------------
    | Invitations
    |----------------------------------
    */
    public function invitations(): HasMany
    {
        return $this->hasMany(BudgetInvitation::class, 'budget_id');
    }

    public function pendingInvitations(): HasMany
    {
        return $this->invitations()->where('state', BudgetInvitation::STATE_PENDING);
    }
}
