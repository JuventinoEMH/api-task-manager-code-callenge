<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::factory()
            ->withPassword('password123')
            ->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);


        Project::factory(3)->create([
            'user_id' => $user->id,
        ]);


        $this->command->info("User created with the following credentials:");
        $this->command->info("Email: admin@example.com");
        $this->command->info("Passwodr: password123");
    }
}
