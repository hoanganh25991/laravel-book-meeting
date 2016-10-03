<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingUser extends Model
{
    protected $table = 'booking_user';
    protected $fillable = ['user_id', 'booking_id'];

    public function bookings(){
        return $this->hasMany(Booking::class, 'id', 'booking_id');
    }
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function booking(){
        return $this->hasOne(Booking::class, 'id', 'booking_id');
    }

}
