<?php

use App\Domains\Users\Models\User;
use App\Http\Livewire\Auth\EmailVerificationRequestForm;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use function Pest\Livewire\livewire;

// test the page is accessible
test('the email verification page is accessible', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('verification.notice'));

    $response->assertStatus(200);
});

// test the livewire component is present
test('the email verification page contains the livewire component', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('verification.notice'));

    $response->assertSeeLivewire(EmailVerificationRequestForm::class);
});

// test the page is not accessible when logged out
test('the email verification page is not accessible when logged out', function () {
    $response = $this->get(route('verification.notice'));

    $response->assertRedirect(route('login'));
});

// test the page is accessible when logged in
test('the email verification page is accessible when logged in', function () {
    $user = User::factory()->verified()->create();

    $response = $this->actingAs($user)->get(route('verification.notice'));

    $response->assertStatus(200);
});

// test when the user attempts to resend the verification email it is sent
test('when the user attempts to resend the verification email it is sent', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user);

    livewire(EmailVerificationRequestForm::class)
        ->assertDontSee('Verification link sent! Check your email inbox.')
        ->call('attempt')
        ->assertHasNoErrors(['status'])
        ->assertSee('Verification link sent! Check your email inbox.');
});

// test the user cannot resend the verification email more than twice in a minute
test('the user cannot resend the verification email more than twice in a minute', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user);

    livewire(EmailVerificationRequestForm::class)
        ->call('attempt')
        ->call('attempt')
        ->call('attempt')
        ->assertHasErrors(['status']);
});

// test the notification is sent to the user
test('the notification is sent to the user', function () {
    Notification::fake([
        VerifyEmail::class,
    ]);

    $user = User::factory()->unverified()->create();

    $this->actingAs($user);

    livewire(EmailVerificationRequestForm::class)
        ->call('attempt');

    Notification::assertSentTo($user, VerifyEmail::class);
});
