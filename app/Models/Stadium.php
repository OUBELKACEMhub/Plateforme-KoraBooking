<?php

namespace App\Models;
use App\Models\Reservation;
use App\Models\Offer;
use App\Models\Review;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    
 protected $fillable = [
        'name',
        'city',
        'address',
        'price',
        'image',
        'rate',
        'latitude',
        'longitude',
        'manager_id',
    ];

    protected $casts = [
        'price' => 'double',
        'rate' => 'float',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];


            public function reservations()
        {
            return $this->hasMany(Reservation::class);
        }

        public function reviews()
        {
            return $this->hasMany(Review::class);
        }

        public function getAverageRatingAttribute()
    {
        $average = $this->reviews()->avg('rating');
        
        return $average ? round($average, 1) : 0; 
    }

        public function offers()
        {
            return $this->belongsToMany(Offer::class, 'offer_stadium');
        }
}
