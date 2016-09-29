<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Booking extends Model
{
    protected $fillable = ['date', 'room_id', 'created_by', 'description'];

    public static function boot(){
        parent::boot();

        static::created(function($booking){
            $user_id = Auth::id();
            $booking_id = $booking->id;
            $userBooking = new UserBooking(
                compact('user_id', 'booking_id')
            );
//            $userBooking = new UserBooking();
//            $userBooking->user_id = $user_id;
//            $userBooking->booking_id = $booking_id;
            try{
                $userBooking->save();
            }catch(\Exception $e){
                dd($e);
            }
        });
    }
}
