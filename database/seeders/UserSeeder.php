<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'juntech',
            'email' => 'juntech3372@gmail.com',
            'password' => Hash::make('bayanibayani3372@'),
            'role' => 'admin',
        ]);
    }
}