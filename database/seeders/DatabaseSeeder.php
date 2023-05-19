<?php

namespace Database\Seeders;

use App\Domains\Users\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create a test user
        $user = User::factory()->verified()->create([
            'name' => 'Wyatt',
            'nickname' => 'Wyatt',
            'email' => 'user@email.com',
        ]);

        // create an income for the personal budget
        $user->personalBudget()->incomes()->create([
            'name' => 'Wyatt Salary',
        ]);

        $user->personalBudget()->incomes()->create([
            'name' => 'Side hustle',
        ]);

        $user->personalBudget()->incomes()->create([
            'name' => 'Amber Salary',
        ]);
    }
}
