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
        $user = User::factory()->unverified()->create([
            'email' => 'user@email.com',
        ]);

        // create an income for the personal budget
        $user->personalBudget()->incomes()->create([
            'name' => 'Salary',
            'description' => 'My monthly salary',
            'amount' => 100000,
            'start_date' => now()->subWeek(),
        ]);

        $user->personalBudget()->incomes()->create([
            'name' => 'Disability',
            'description' => 'Disability income from the government',
            'amount' => 32150,
            'start_date' => now()->subMonth(),
        ]);
    }
}
