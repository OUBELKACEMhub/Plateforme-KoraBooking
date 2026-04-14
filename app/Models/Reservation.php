<?php

namespace App\Models;
use App\Models\Stadium;
use App\Models\User;
use App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'user_id',
    'stadium_id',
    'start_time',
    'end_time',
    'final_price',
    'status',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
