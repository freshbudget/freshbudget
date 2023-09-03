<?php

use App\Models\User;

// an authenticated user can logout
test('an authenticated user can logout', function () {
    $user = User::factory()->create();
    auth()->login($user);
    $this->assertAuthenticatedAs($user);
    $this->actingAs($user)->post(route('logout'));
    $this->assertGuest();
});

// test if a user is not authenticated they are redirected to the login page
test('if a user is not authenticated they are redirected to the login page', function () {
    $response = $this->post(route('logout'));
    $response->assertRedirect(route('login'));
});
