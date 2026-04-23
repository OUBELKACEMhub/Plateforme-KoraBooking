<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;
use App\Models\Stadium;
use App\Models\User;
use Carbon\Carbon;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creator = User::where('role', 'admin')->first() ?? User::first();

        if (!$creator) {
            $this->command->info("Makayn 7ta user f la base. Khassk t-seeder les users 9bel les offres.");
            return;
        }

        // 2. Le Tableau des offres (Data)
        $offers = [
            [
                'type' => 'seasonal', // Promo Ramadan (Mounassaba)
                'discount_percentage' => 20.00,
                'start_date' => Carbon::now()->startOfDay(),
                'end_date' => Carbon::now()->addDays(30)->endOfDay(),
            ],
            [
                'type' => 'seasonal', // Happy Hour Weekend (Mawsimi/Moukarrar)
                'discount_percentage' => 15.00,
                'start_date' => Carbon::now()->next(Carbon::SATURDAY)->startOfDay(),
                'end_date' => Carbon::now()->next(Carbon::SUNDAY)->endOfDay(),
            ],
            [
                'type' => 'flash', // Flash Sale (Takhfid sari3)
                'discount_percentage' => 50.00,
                'start_date' => Carbon::now()->startOfDay(),
                'end_date' => Carbon::now()->addDays(2)->endOfDay(),
            ]
        ];
        $stadiums = Stadium::all();

        foreach ($offers as $offerData) {
            $offerData['creator_id'] = $creator->id;

         $offer = Offer::create($offerData);

            if ($stadiums->count() > 0) {
                $randomStadiumsIds = $stadiums->random(min(2, $stadiums->count()))->pluck('id')->toArray();
                
                $offer->stadiums()->attach($randomStadiumsIds);
            }
        }

        $this->command->info('Les offres a été ajouter avec  succeés avec leurs les terrains  !');
    }
}