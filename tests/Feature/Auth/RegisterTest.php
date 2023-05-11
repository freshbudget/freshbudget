<?php

// test the register page is accessible

use App\Domains\Users\Models\User;
use App\Http\Livewire\Auth\RegisterForm;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use function Pest\Livewire\livewire;

test('register page is accessible', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

// test the register page is at /register
test('register page is at /register', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

/// assert we see the livewire component on the page
test('register page contains livewire component', function () {
    $response = $this->get(route('register'));

    $response->assertSeeLivewire(RegisterForm::class);
});

// authenticated users are redirected to the welcome page
test('authenticated users are redirected to the welcome page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('register'));

    $response->assertRedirect(route('welcome'));
});

// test name is required
test('name is required and must be between 2 and 255 chars', function () {
    livewire(RegisterForm::class)
        ->set('name', '')
        ->set('email', 'user@email.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['name' => 'required']);

    livewire(RegisterForm::class)
        ->set('name', 'a')
        ->set('email', 'user@email.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['name' => 'min']);

    livewire(RegisterForm::class)
        ->set('name', str_repeat('a', 256))
        ->set('email', 'user@email.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['name' => 'max']);
});

// test email is required
test('email is required and must be a valid email address', function () {
    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', '')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['email' => 'required']);

    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', 'not-an-email')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['email' => 'email']);
});

// test email must be unique
test('email must be unique', function () {
    $user = User::factory()->create();

    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', $user->email)
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['email' => 'unique']);
});

// test password is required
test('password is required, must be at least 8 chars, and confirmed', function () {
    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', 'user@email.com')
        ->set('password', '')
        ->set('password_confirmation', 'password')
        ->call('attempt')
        ->assertHasErrors(['password' => 'required']);

    // dont know how to test this yet when using Password::defaults()
    // livewire(RegisterForm::class)
    //     ->set('name', 'John Doe')
    //     ->set('email', 'user@email.com')
    //     ->set('password', 'pass')
    //     ->set('password_confirmation', 'pass')
    //     ->call('attempt')
    //     ->assertHasErrors(['password' => 'min']);

    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', 'user@email.com')
        ->set('password', 'password123')
        ->set('password_confirmation', '')
        ->call('attempt')
        ->assertHasErrors(['password' => 'confirmed']);
});

// test valid inputs register a user
test('valid inputs register a user', function () {
    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', 'user@email.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('attempt')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('users', [
        'email' => 'user@email.com',
    ]);
});

// test a registered event is dispatched
test('a registed event is dispatched', function () {
    Event::fake([
        Registered::class,
    ]);

    livewire(RegisterForm::class)
        ->set('name', 'John Doe')
        ->set('email', 'user@email.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('attempt')
        ->assertHasNoErrors();

    $this->assertAuthenticated();

    Event::assertDispatched(Registered::class);
});
