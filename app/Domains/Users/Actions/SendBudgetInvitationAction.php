<?php

namespace App\Domains\Users\Actions;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Budgets\Notifications\InvitedToBudgetNotification;
use App\Domains\Users\Exceptions\CannotSendInvitationsForBudgetYouDontOwn;
use App\Domains\Users\Exceptions\InvitationFailedToSend;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Notification;

class SendBudgetInvitationAction
{
    public function execute(User $sender, Budget $budget, string $email, $name, $nickname): BudgetInvitation
    {
        // ensure the sender is the owner of the budget
        if (! $budget->isOwnedBy($sender)) {
            throw new CannotSendInvitationsForBudgetYouDontOwn();
        }

        // ensure the recipient isn't already a member of the budget
        if ($budget->hasUserWithEmail($email)) {
            throw new \Exception('The user you are inviting is already a member of the budget.');
        }

        // create the invitation
        $invitation = $budget->invitations()->create([
            'email' => $email,
            'name' => $name,
            'nickname' => $nickname,
            'sender_id' => $sender->id,
            'state' => BudgetInvitation::STATE_PENDING,
        ]);

        // route an email notification to the recipient
        try {
            Notification::route('mail', $email)
                ->notify(new InvitedToBudgetNotification($invitation));
        } catch (\Exception $e) {
            report($e);

            $invitation->markAsFailed();

            throw new InvitationFailedToSend();
        }

        return $invitation;
    }
}
