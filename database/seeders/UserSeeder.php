<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'Staff Gudang',
        ]);

        User::create([
            'name' => 'Manajer Gudang',
            'email' => 'manager@stockify.com',
            'password' => Hash::make('password'),
            'role' => 'Manajer Gudang',
        ]);
    }
}