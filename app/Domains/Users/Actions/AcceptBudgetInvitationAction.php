<?php

namespace App\Domains\Users\Actions;

use App\Domains\Budgets\Events\BudgetInvitationAccepted;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Budgets\Notifications\InvitationAcceptedNotification;
use App\Domains\Users\Models\User;

class AcceptBudgetInvitationAction
{
    public function execute(User $recipient, BudgetInvitation $invitation)
    {
        // ensure that the recipient email matches the invitation email
        if ($recipient->email !== $invitation->email) {
            throw new \Exception('You cannot accept an invitation that was not sent to you.');
        }

        // ensure the invitaition isnt expired
        if ($invitation->isExpired()) {
            throw new \Exception('You cannot accept an expired invitation.');
        }

        // ensure the invitation wasn't already rejected
        if ($invitation->isRejected()) {
            throw new \Exception('You cannot accept a rejected invitation.');
        }

        // ensure the invitation wasn't already accepted
        if ($invitation->isAccepted()) {
            return;
        }

        // ensure the budget still exists
        if (! $invitation->budget) {
            throw new \Exception('You cannot accept an invitation to a budget that no longer exists.');
        }

        // ensure the recipient doesn't already belong to the budget
        if ($invitation->budget->hasUser($recipient)) {
            throw new \Exception('You cannot accept an invitation to a budget you already belong to.');
        }

        // add the recipient to the budget
        $invitation->budget->addUser($recipient);

        // mark the invitation as accepted
        $invitation->markAsAccepted();

        // fire the invitation accepted event
        event(new BudgetInvitationAccepted($invitation));

        // notify the sender that the invitation was accepted
        $invitation->sender->notify(new InvitationAcceptedNotification($invitation));
    }
}
