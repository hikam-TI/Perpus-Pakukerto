<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Pakukerto',
            'username' => 'admin',
            'email' => 'admin@pakukerto.local',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'username' => 'user',
            'email' => 'user@pakukerto.local',
            'password' => Hash::make('user1234'),
            'role' => 'user',
        ]);
    }
}
