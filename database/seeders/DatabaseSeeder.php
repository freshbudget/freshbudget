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
            'name' => 'Wyatt Castaneda',
            'nickname' => 'Wyatt',
            'email' => 'user@email.com',
        ]);
    }
}
