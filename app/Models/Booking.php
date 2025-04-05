<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'status',
        'payment_confirmation',
        'no_of_persons',
        'total_amount',
    ];


    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the user associated with the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
