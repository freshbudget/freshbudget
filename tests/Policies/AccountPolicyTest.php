<?php

use App\Models\User;
use App\Policies\AccountPolicy;

// test that a user can create an account
test('a user can create an account', function () {
    $user = User::factory()->create();

    $budget = $user->personalBudget();

    $policy = (new AccountPolicy());

    $this->assertTrue($policy->create($user, $budget));
});
