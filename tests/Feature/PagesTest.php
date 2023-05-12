<?php

test('the home page is accessible', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response = $this->get(route('welcome'));
    $response->assertStatus(200);
});

// the terms page is accessible
test('the terms page is accessible', function () {
    $response = $this->get('/terms');
    $response->assertStatus(200);
    $response = $this->get(route('terms'));
    $response->assertStatus(200);
});

// the privacy page is accessible
test('the privacy page is accessible', function () {
    $response = $this->get('/privacy');
    $response->assertStatus(200);
    $response = $this->get(route('privacy'));
    $response->assertStatus(200);
});
