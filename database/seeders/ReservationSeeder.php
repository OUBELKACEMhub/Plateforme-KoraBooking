<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    // database/seeders/ReservationSeeder.php
public function run(): void
{
    \App\Models\Reservation::create([
        'user_id' => 2, // Le client Yassine
        'stadium_id' => 1,
        'start_time' => now()->addDays(1)->setHour(18),
        'end_time' => now()->addDays(1)->setHour(19),
        'final_price' => 300.00,
        'status' => 'confirmed'
    ]);
}
}
