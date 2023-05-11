<?php 

// test the welcome page is at the root domain
test('welcome page is at the root domain', function () {
    expect(route('welcome'))->toBe('http://freshbudgetapp.test');
});

// test the auth pages are at the app subdomain
test('auth pages are at the app subdomain', function () {
    expect(route('login'))->toBe('http://app.freshbudgetapp.test/login');
});

// test the marketing pages are at the root domain
test('marketing pages are at the root domain', function () {
    expect(route('welcome'))->toBe('http://freshbudgetapp.test');
});

// test the app pages are at the app subdomain
test('app pages are at the app subdomain', function () {
    expect(route('app.index'))->toBe('http://app.freshbudgetapp.test');
});

// test the api pages are at the api subdomain - TODO