<?php

// test the login page is accessible
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

    $response->assertSeeLivewire('auth.login-form');
});