<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    
public function run(): void
{
    \App\Models\User::create([
        'name' => 'Ahmed Admin',
        'email' => 'admin@korabooking.ma',
        'password' => bcrypt('password'),
        'role' => 'admin',
        'referral_code' => 'ADMIN2026'
    ]);

    \App\Models\User::create([
        'name' => 'Yassine Client',
        'email' => 'yassine@gmail.com',
        'password' => bcrypt('password'),
        'role' => 'customer',
        'referral_code' => 'YASS77'
    ]);
}
}
