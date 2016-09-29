<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBooking extends Model
{
    protected $table = 'user_booking';
    protected $fillable = ['user_id', 'booking_id'];

    public function bookings(){
        return $this->hasMany(Booking::class, 'id', 'booking_id');
    }
}
