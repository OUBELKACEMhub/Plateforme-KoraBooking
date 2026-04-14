<?php

namespace App\Models;
use App\Models\Reservation;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    'reservation_id',
    'paid_by',
];

    public function reservation() { return $this->belongsTo(Reservation::class); }
}
