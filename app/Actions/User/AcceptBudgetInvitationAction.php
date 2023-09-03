<?php

namespace App\Actions\User;

use App\Events\Budgets\BudgetInvitationAccepted;
use App\Exceptions\CannotAcceptExpiredInvitation;
use App\Exceptions\CannotAcceptInvitationBudgetDeleted;
use App\Exceptions\CannotAcceptInvitationNotSentToYou;
use App\Exceptions\CannotAcceptRejectedInvitation;
use App\Models\BudgetInvitation;
use App\Models\User;
use App\Notifications\InvitationAcceptedNotification;

class AcceptBudgetInvitationAction
{
    public function execute(User $recipient, BudgetInvitation $invitation)
    {
        // ensure that the recipient email matches the invitation email
        if ($recipient->email !== $invitation->email) {
            throw new CannotAcceptInvitationNotSentToYou();
        }

        // ensure the invitaition isnt expired
        if ($invitation->isExpired()) {
            throw new CannotAcceptExpiredInvitation();
        }

        // ensure the invitation wasn't already rejected
        if ($invitation->isRejected()) {
            throw new CannotAcceptRejectedInvitation();
        }

        // ensure the invitation wasn't already accepted
        // if so we can just return because the end state
        // has already been achieved
        if ($invitation->isAccepted()) {
            return;
        }

        // ensure the budget still exists
        if (! $invitation->budget) {
            throw new CannotAcceptInvitationBudgetDeleted();
        }

        // ensure the recipient doesn't already belong to the budget
        // if so we can just return because the end state
        // has already been achieved
        if ($invitation->budget->hasMember($recipient)) {
            return;
        }

        // add the recipient to the budget
        $invitation->budget->addMember($recipient);

        // mark the invitation as accepted
        $invitation->markAsAccepted();

        // fire the invitation accepted event
        event(new BudgetInvitationAccepted($invitation));

        // notify the sender that the invitation was accepted
        $invitation->sender->notify(new InvitationAcceptedNotification($invitation));
    }
}
