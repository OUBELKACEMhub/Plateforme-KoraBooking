<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Stadium;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferStadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offerIds = Offer::pluck('id')->toArray();
        $stadiumIds = Stadium::pluck('id')->toArray();

        if (empty($offerIds) || empty($stadiumIds)) {
            $this->command->info('Veuillez d\'abord remplir les tables Offers et Stadiums.');
            return;
        }

        for ($i = 0; $i < 7; $i++) {
            
            $randomOfferId = $offerIds[array_rand($offerIds)];
            $randomStadiumId = $stadiumIds[array_rand($stadiumIds)];

       
            DB::table('offer_stadium')->insertOrIgnore([
                'offer_id' => $randomOfferId,
                'stadium_id' => $randomStadiumId,
            ]);
        }
    }
}