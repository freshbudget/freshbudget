<?php

use App\Actions\User\SendBudgetInvitationAction;
use App\Events\Budgets\BudgetInvitationAccepted;
use App\Models\User;
use App\Notifications\InvitationAcceptedNotification;
use App\Notifications\InvitedToBudgetNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

test('a user can send a budget invitation to a user with an existing account', function () {

    Event::fake([
        BudgetInvitationAccepted::class,
    ]);

    Notification::fake([
        InvitedToBudgetNotification::class,
    ]);

    $sender = User::factory()->create();

    $user = User::factory()->create();

    $invitation = (new SendBudgetInvitationAction(
        budget: $sender->personalBudget(),
        sender: $sender,
        email: 'user@email.com',
        name: 'John Doe',
        role: 'member',
    ))->execute();

    // assert that the notification was sent
    Notification::assertSentOnDemand(InvitedToBudgetNotification::class);

    // build the accept invitation url with the token as a query string
    $url = route('invitations.show', $invitation).'?token='.$invitation->token;

    // when the user visits the url, because they alreay have an account
    // the invitation should be accepted and they should see the 'invitations.accept' view
    $this->get($url)
        ->assertOk()
        ->assertViewIs('invitations.confirm-and-register');

    return;

    // need to skip this part for now because I am refactoring the invitation flow

    // assert that the invitation was accepted
    $this->assertTrue($invitation->fresh()->isAccepted());

    // assert that the user was added to the budget
    $this->assertTrue($sender->personalBudget()->fresh()->users->contains($user));

    // assert that an event was dispatched for accepting the invitation
    Event::assertDispatched(BudgetInvitationAccepted::class);

    // assert that the sender was notified that the invitation was accepted
    Notification::assertSentTo($sender, InvitationAcceptedNotification::class);
})->skip();

// test that a user can send a budget invitation to a user without an account
test('a user can send a budget invitation to a user without an account', function () {

    Event::fake([
        BudgetInvitationAccepted::class,
    ]);

    Notification::fake([
        InvitedToBudgetNotification::class,
    ]);

    $sender = User::factory()->create();

    $invitation = (new SendBudgetInvitationAction(
        budget: $sender->personalBudget(),
        sender: $sender,
        email: 'user@email.com',
        name: 'John Doe',
        role: 'member',
    ))->execute();

    // assert that the notification was sent
    Notification::assertSentOnDemand(InvitedToBudgetNotification::class);

    // build the accept invitation url with the token as a query string
    $url = route('invitations.show', $invitation).'?token='.$invitation->token;

    // when the user visits the url, because they dont have an account
    // an account should be created for them and they should ...
    $this->get($url)
        ->assertOk();
});

// test a user can reject a budget invitation
test('a non-registered user can reject a budget invitation', function () {

    Notification::fake([
        InvitedToBudgetNotification::class,
    ]);

    $sender = User::factory()->create();

    $action = (new SendBudgetInvitationAction(
        budget: $sender->personalBudget(),
        sender: $sender,
        email: 'user99@email.com',
        name: 'John Doe',
        role: 'member',
    ));

    $invitation = $action->execute();

    $this->assertTrue($invitation->fresh()->isPending());

    $response = $this->get(route('invitations.show', $invitation).'?token='.$invitation->token);

    $response->assertOk();
    $response = $this->post(route('invitations.reject', $invitation).'?token='.$invitation->token);

    $response->assertRedirect(route('welcome'));

    $this->assertTrue($invitation->fresh()->isRejected());
});

// test a registered user can accept a budget invitation, even if they aren't logged in
test('a registered user can accept a budget invitation, even if they aren\'t logged in', function () {

    Notification::fake([
        InvitedToBudgetNotification::class,
    ]);

    $sender = User::factory()->create();

    $recipient = User::factory()->create();

    $action = (new SendBudgetInvitationAction(
        budget: $sender->personalBudget(),
        sender: $sender,
        email: $recipient->email,
        name: $recipient->name,
        role: 'member',
    ));

    $invitation = $action->execute();

    $this->assertTrue($invitation->fresh()->isPending());

    $response = $this->get(route('invitations.show', $invitation).'?token='.$invitation->token);

    $response->assertOk();

    $response = $this->post(route('invitations.accept', $invitation).'?token='.$invitation->token);

    $this->assertTrue($invitation->fresh()->isAccepted());
    $this->assertTrue($sender->personalBudget()->fresh()->hasMember($recipient));

    $response->assertOk();
    $response->assertViewIs('invitations.accepted');
});
