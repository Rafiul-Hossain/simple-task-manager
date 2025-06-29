<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Only seed tasks for all existing users
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            \App\Models\Task::factory()->count(10)->create(['user_id' => $user->id]);
        }
    }
}
