<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use App\Models\Stadium;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        $userIds = User::pluck('id')->toArray();
        $stadiumIds = Stadium::pluck('id')->toArray();

        if (empty($userIds) || empty($stadiumIds)) {
            $this->command->info('Veuillez d\'abord remplir les tables Users et Stadiums.');
            return;
        }

        $comments = [
            "Terrain wa3er bzaf, l-gazon jdid w n9i. Ghadi n-rj3o n-l3bo hna akid!",
            "L-khedma n9iya w les vestiaires fihom douch mzyan. Top!",
            "Terrain mzyan walakin l-idha2a (l-dow) na9ssa chwiya f l-lil.",
            "A7ssan terrain l3bt fih had ch'her. L-mdiyer drafat w m-rtbin.",
            "Mzyan l-matchat dyal 5x5, walakin chwiya ghali bel mo9arana m3a lakhrin.",
            "Expérience zwina, kolchi howa hadak w l-kora li 3tawna kbira w jdida.",
            "L-parking sghir chwiya, walakin l-terrain dakhil n9i w l-gazon snthetique wa3er.",
            "Service au top ! Réservation dazt bzzerba w l-accueil kan mzyan.",
        ];

        for ($i = 0; $i < 20; $i++) {
            Review::create([
                'user_id' => $faker->randomElement($userIds),
                'stadium_id' => $faker->randomElement($stadiumIds),
                
                // Rating bin 3 w 5 (bach l-application tban fiha terrains mzyanin ghaliban)
                'rating' => $faker->numberBetween(3, 5), 
                
                // N-3zlou commentaire 3achwa2i mn l-liste li gadina lfou9
                'comment' => $faker->randomElement($comments),
            ]);
        }
    }
}