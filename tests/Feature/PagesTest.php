<?php

$routes = [
    'welcome',
    'terms',
    'privacy',
];

$namedRoutes = [
    'welcome',
    'terms',
    'privacy',
];

test('certain uris are accessible', function () use ($routes) {
    foreach ($routes as $route) {
        $response = $this->get($route);
        $response->assertStatus(200);
    }
});

// test certain named routes are accessible
test('certain named routes are accessible', function () use ($namedRoutes) {
    foreach ($namedRoutes as $route) {
        $response = $this->get(route($route));
        $response->assertStatus(200);
    }
});
