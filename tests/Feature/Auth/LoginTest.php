<?php

// test the login page is accessible

use App\Domains\Users\Models\User;
use App\Http\Livewire\Auth\LoginForm;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Event;
use function Pest\Livewire\livewire;

test('login page is accessible', function () {
    $response = $this->get(route('login'));

    $response->assertStatus(200);
});

// test the login page is at /login
test('login page is at /login', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

// assert we see the livewire component on the page
test('login page contains livewire component', function () {
    $response = $this->get(route('login'));

    $response->assertSeeLivewire(LoginForm::class);
});

// test authenticated users are redirected to the welcome page
test('authenticated users are redirected to the welcome page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('login'));

    $response->assertRedirect(route('welcome'));
});

// tes email is required
test('email is required', function () {
    livewire(LoginForm::class)
        ->set('email', '')
        ->set('password', 'password')
        ->call('attempt')
        ->assertHasErrors(['email' => 'required']);
});

// test password is required
test('password is required', function () {
    livewire(LoginForm::class)
        ->set('email', 'user@email.com')
        ->set('password', '')
        ->call('attempt')
        ->assertHasErrors(['password' => 'required']);
});

// test the email must be a valid email address
test('email must be a valid email address', function () {
    livewire(LoginForm::class)
        ->set('email', 'not-a-valid-email')
        ->set('password', 'password')
        ->call('attempt')
        ->assertHasErrors(['email' => 'email']);
});

// test if the email does not exist in the database a status error is returned
test('if the email does not exist in the database a status error is returned', function () {
    livewire(LoginForm::class)
        ->set('email', 'user@email.com')
        ->set('password', 'password')
        ->call('attempt')
        ->assertHasErrors(['status']);
});

// test valid credentials are authenticated
test('valid credentials are authenticated', function () {
    $user = User::factory()->create();

    livewire(LoginForm::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('attempt')
        ->assertHasNoErrors()
        ->assertRedirect(route('app.index'));

    $this->assertAuthenticatedAs($user);
});

// test an authenticated event is fired
test('an authenticated event is fired', function () {
    Event::fake([
        Authenticated::class,
    ]);

    $user = User::factory()->create();

    livewire(LoginForm::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('attempt')
        ->assertHasNoErrors()
        ->assertRedirect(route('app.index'));

    $this->assertAuthenticatedAs($user);

    Event::assertDispatched(Authenticated::class, function ($event) use ($user) {
        return $event->guard === 'web' && $event->user->is($user);
    });
});

// test the component is rate limited
test('the component is rate limited to 10 attempts in 1 minute', function () {

    for ($i = 0; $i < 10; $i++) {
        livewire(LoginForm::class)
            ->set('email', 'not-a-valid-email')
            ->set('password', 'password')
            ->call('attempt');
    }

    // the 11th attempt should be rate limited
    livewire(LoginForm::class)
        ->set('email', 'user@email.com')
        ->set('password', 'password')
        ->call('attempt')
        ->assertHasErrors(['status']);
});

// test if the user has two factor auth enabled they are redirected to the 2fa challenge
test('if user has 2FA enabled they are redirected to the 2FA challenge after authenticating', function () {
    $user = User::factory()->withTwoFactorAuth()->create();

    livewire(LoginForm::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('attempt')
        ->assertRedirect(route('app.index'));
});

// test if the user has 2FA enabled they are redirected to the 2fa challenge and the session is flashed
test('if user has 2FA enabled they are redirected to the 2FA challenge and the session is flashed', function () {
    $user = User::factory()->withTwoFactorAuth()->create();

    livewire(LoginForm::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('attempt')
        ->assertRedirect(route('app.index'))
        ->assertSessionHas('two_factor');
});
