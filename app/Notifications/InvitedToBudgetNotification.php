<?php

namespace App\Notifications;

use App\Models\BudgetInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitedToBudgetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public BudgetInvitation $invitation)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line(
                "You've been invited to join the budget `{$this->invitation->budget->name}` on ".config('app.name')." by {$this->invitation->sender->name}."
            )
            ->action('View Invitation', route('invitations.show', $this->invitation).'?token='.$this->invitation->token)
            ->line("This invitation will expire in one week ({$this->invitation->expires_at->format('d-M-Y')}). If you did not expect this invitation, you can simply ignore this email.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
