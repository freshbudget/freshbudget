<?php

test('the home page is accessible', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertViewIs('marketing.index');

    $response = $this->get(route('welcome'));
    $response->assertStatus(200);
});
