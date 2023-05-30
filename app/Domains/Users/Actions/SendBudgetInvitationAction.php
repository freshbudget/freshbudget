<?php

namespace App\Domains\Users\Actions;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Budgets\Notifications\InvitedToBudgetNotification;
use App\Domains\Users\Exceptions\InvitationFailedToSend;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Notification;

class SendBudgetInvitationAction
{
    public function __construct(
        public Budget $budget, 
        public User $sender, 
        public string $email, 
        public string $name, 
        public string|null $nickname = null)
    {
        //
    }

    public function execute(): BudgetInvitation
    {
        if ($this->budget->hasMemberWithEmail($this->email)) {
            $invitation = $this->budget->invitations()
                ->where('email', $this->email)
                ->where('budget_id', $this->budget->id)
                ->firstOrFail();

            return $invitation;
        }

        $invitation = $this->budget->invitations()->create([
            'email' => $this->email,
            'name' => $this->name,
            'nickname' => $this->nickname,
            'sender_id' => $this->sender->id,
            'state' => BudgetInvitation::STATE_PENDING,
        ]);

        try {
            Notification::route('mail', $this->email)
                ->notify(new InvitedToBudgetNotification($invitation));
        } catch (\Exception $e) {
            report($e);

            $invitation->markAsFailed();

            throw new InvitationFailedToSend();
        }

        return $invitation;
    }
}
