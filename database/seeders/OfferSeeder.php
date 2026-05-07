<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

  
        $managersIds = User::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            
            $startDate = $faker->dateTimeBetween('-1 month', '+1 month');
            
            $endDate = (clone $startDate)->modify('+' . rand(3, 15) . ' days');

            Offer::create([
                'creator_id' => $faker->randomElement($managersIds) ?? 1,
                'discount_percentage' => $faker->numberBetween(10, 50), // Remise bin 10% w 50%
                'type' => $faker->randomElement(['flash', 'seasonal', 'promo']), // L-anwa3 li 3ndek
                'start_date' => Carbon::parse($startDate)->format('Y-m-d'),
                'end_date' => Carbon::parse($endDate)->format('Y-m-d'),
            ]);
        }
    }
}