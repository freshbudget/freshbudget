<?php

use App\Domains\Users\Models\User;

// test the dashboard is accessible by a logged in user
test('dashboard is not accessible to guests, only authenticated users', function () {
    $response = $this->get(route('app.index'));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('app.index'));
    $response->assertStatus(200);
});

// test the income page is accessible by a logged in user
test('incomes page is not accessible to guests, only authenticated users', function () {
    $response = $this->get(route('app.incomes.index'));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('app.incomes.index'));
    $response->assertStatus(200);
});