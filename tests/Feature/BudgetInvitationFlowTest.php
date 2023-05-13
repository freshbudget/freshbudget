<?php

use App\Domains\Budgets\Events\BudgetInvitationAccepted;
use App\Domains\Budgets\Notifications\InvitationAcceptedNotification;
use App\Domains\Budgets\Notifications\InvitedToBudgetNotification;
use App\Domains\Users\Models\User;
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

    $invitation = $sender->inviteToBudget(
        budget: $sender->personalBudget(),
        email: $user->email,
        name: $user->name,
        nickname: $user->nickname
    );

    // assert that the notification was sent
    Notification::assertSentOnDemand(InvitedToBudgetNotification::class);

    // build the accept invitation url with the token as a query string
    $url = route('invitations.accept', $invitation).'?token='.$invitation->token;

    // when the user visits the url, because they alreay have an account
    // the invitation should be accepted and they should see the 'invitations.accept' view
    $this->get($url)
        ->assertOk()
        ->assertViewIs('invitations.accept');

    // assert that the invitation was accepted
    $this->assertTrue($invitation->fresh()->isAccepted());

    // assert that the user was added to the budget
    $this->assertTrue($sender->personalBudget()->fresh()->users->contains($user));

    // assert that an event was dispatched for accepting the invitation
    Event::assertDispatched(BudgetInvitationAccepted::class);

    // assert that the sender was notified that the invitation was accepted
    Notification::assertSentTo($sender, InvitationAcceptedNotification::class);
});

// test that a user can send a budget invitation to a user without an account
test('a user can send a budget invitation to a user without an account', function () {

    Event::fake([
        BudgetInvitationAccepted::class,
    ]);

    Notification::fake([
        InvitedToBudgetNotification::class,
    ]);

    $sender = User::factory()->create();

    $invitation = $sender->inviteToBudget(
        budget: $sender->personalBudget(),
        email: 'user@email.com',
        name: 'John Doe',
    );

    // assert that the notification was sent
    Notification::assertSentOnDemand(InvitedToBudgetNotification::class);

    // build the accept invitation url with the token as a query string
    $url = route('invitations.accept', $invitation).'?token='.$invitation->token;

    // when the user visits the url, because they dont have an account
    // an account should be created for them and they should ...
    $this->get($url)
        ->assertOk();
});
