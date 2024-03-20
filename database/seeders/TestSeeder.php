<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Test Admin', 'password' => bcrypt('password')],
        );

        $user->assignRole('admin');
        $user->save();

        $user2 = User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')],
        );

        $team = Team::updateOrCreate([
            'name' => 'Test',
        ]);

        $user2->teams()->attach($team);
    }
}
