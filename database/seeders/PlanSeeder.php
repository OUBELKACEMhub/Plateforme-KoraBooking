<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
   // database/seeders/PlanSeeder.php
public function run(): void
{
    \App\Models\Plan::create([
        'name' => 'Pack Pro',
        'monthly_price' => 500.00,
        'discount_percentage' => 15.0,
        'duration_days' => 30
    ]);
    
    \App\Models\Plan::create([
        'name' => 'Pack Elite',
        'monthly_price' => 1200.00,
        'discount_percentage' => 25.0,
        'duration_days' => 90
    ]);
}
}
