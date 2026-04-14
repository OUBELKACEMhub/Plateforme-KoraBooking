<?php

namespace App\Models;
use App\Models\Stadium;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
    'creator_id',
    'discount_percentage',
    'type',
    'start_date',
    'end_date',
];

public function stadiums()
{
    return $this->belongsToMany(Stadium::class, 'offer_stadium');
}

   public function creator()
{
    return $this->belongsTo(User::class, 'creator_id');
}



}
