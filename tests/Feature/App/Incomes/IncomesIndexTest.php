<?php

use App\Models\User;

// test the incomes index page is not accessible by a guest but is accessible by a logged in user
test('incomes index page is not accessible to guests, only authenticated users', function () {
    $response = $this->get(route('app.incomes.index'));
    $response->assertStatus(302);
    $response->assertRedirect(route('login'));

    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('app.incomes.index'));
    $response->assertStatus(200);
});
