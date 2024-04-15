<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'user',
            'email' => 'user@example.net',
            'password' => Hash::make('password')
        ]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.net',
            'password' => Hash::make('password')
        ]);

        $root = User::create([
            'name' => 'root',
            'email' => 'root@example.net',
            'password' => Hash::make('password')
        ]);
    }
}
