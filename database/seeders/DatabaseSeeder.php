<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // create a test user
        $user = User::factory()->verified()->create([
            'name' => 'Wyatt Castaneda',
            'nickname' => 'Wyatt',
            'email' => 'admin@email.com',
        ]);

        $budget = $user->currentBudget;
    }
}
