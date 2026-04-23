<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Stadium;

class OfferStadiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offers = Offer::all();
        $stadiums = Stadium::all();

        if ($offers->isEmpty() || $stadiums->isEmpty()) {
            $this->command->info('tu doit  cree seederes de les tables  offres et les terrains avant  ma t-lanci had l-seeder!');
            return;
        }

        foreach ($offers as $offer) {
            
            
            $nombreDeTerrains = rand(1, min(3, $stadiums->count())); 
            
            $randomStadiumIds = $stadiums->random($nombreDeTerrains)->pluck('id');

            $offer->stadiums()->syncWithoutDetaching($randomStadiumIds);
        }

        $this->command->info('Les relations entre les offres et les terrains a eté ajouté avec succée dans table offer_stadium!');
    }
}