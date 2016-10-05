<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'address', 'locate', 'description'];

    protected $hidden = ['id'];
    
    public function bookings(){
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
}
