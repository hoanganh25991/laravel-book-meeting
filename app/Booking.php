<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['id', 'pivot'];

    public static function boot(){
        parent::boot();
    }

    public function createdBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    
    public function bookingXUser(){
        return $this->hasOne(BookingUser::class, 'booking_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
    
    public function usersWithStatus(){
        return $this->belongsToMany(User::class)->withPivot('status');
    }

    public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }

//    public function room(){
//        return $this->hasOne(Room::class, 'id', 'room_id');
//    }
}
