<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR'); 

        for ($i = 0; $i < 10; $i++) {
            
            $name = $faker->name;

            User::create([
                'name' => $name,
                'email' => $faker->unique()->safeEmail,
                
                'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=random&color=fff',
                
                'password' => Hash::make('password'),
                
                'role' => $faker->randomElement(['customer', 'manager']),
                
                'wallet_balance' => $faker->randomFloat(2, 0, 1000), 
            ]);
        }
    }
}