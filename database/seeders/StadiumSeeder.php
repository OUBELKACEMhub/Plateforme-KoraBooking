<?php

namespace Database\Seeders;
use \App\Models\Stadium;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StadiumSeeder extends Seeder
{
   
    public function run(): void
    {
        $stadiums = [
            [
                'name' => 'City Arena Safi',
                'city' => 'Safi',
                'address' => 'Plateau, près de YouCode, Safi',
                'price' => 200.00,
                'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800',
                'rate' => 4.8,
                'latitude' => 32.2995,
                'longitude' => -9.2372,
            ],
            [
                'name' => 'Stadium Five Maarif',
                'city' => 'Casablanca',
                'address' => 'Rue de Libourne, Maarif, Casablanca',
                'price' => 300.00,
                'image' => 'https://images.unsplash.com/photo-1556056504-5c7696c4c28d?q=80&w=800',
                'rate' => 4.9,
                'latitude' => 33.5898,
                'longitude' => -7.6320,
            ],
            [
                'name' => 'Green Field Marrakech',
                'city' => 'Marrakech',
                'address' => 'Avenue Mohammed VI, Marrakech',
                'price' => 250.00,
                'image' => 'https://images.unsplash.com/photo-1529900948632-5033b94487a9?q=80&w=800',
                'rate' => 4.6,
                'latitude' => 31.6295,
                'longitude' => -8.0083,
            ],
            [
                'name' => 'Arena Sport Agdal',
                'city' => 'Rabat',
                'address' => 'Quartier Agdal, Rabat',
                'price' => 280.00,
                'image' => 'https://images.unsplash.com/photo-1524015324113-437ec8464972?q=80&w=800',
                'rate' => 4.7,
                'latitude' => 33.9966,
                'longitude' => -6.8485,
            ],
            [
                'name' => 'Shark Stadium',
                'city' => 'Safi',
                'address' => 'Sidi Bouzid, Safi',
                'price' => 180.00,
                'image' => 'https://images.unsplash.com/photo-1543351611-58f69d7c1781?q=80&w=800',
                'rate' => 4.5,
                'latitude' => 32.3275,
                'longitude' => -9.2614,
            ],
            [
                'name' => 'Atlantic Pitch',
                'city' => 'Casablanca',
                'address' => 'Ain Diab, Casablanca',
                'price' => 350.00,
                'image' => 'https://images.unsplash.com/photo-1431324155629-1a6eda1eed15?q=80&w=800',
                'rate' => 4.9,
                'latitude' => 33.5951,
                'longitude' => -7.6888,
            ]
        ];

        foreach ($stadiums as $stadium) {
            Stadium::create($stadium);
        }
    }
}
