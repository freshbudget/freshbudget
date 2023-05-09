<?php

// test the register page is accessible
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

    $response->assertSeeLivewire('auth.register-form');
});