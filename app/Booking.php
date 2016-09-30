<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;
class Booking extends Model
{
    protected $fillable = ['date', 'room_id', 'description'];

    protected $hidden = ['id', 'pivot'];

    public static function boot(){
        parent::boot();

        static::created(function($booking){
            $user_id = Auth::id();
            $booking_id = $booking->id;
            $userBooking = new BookingUser(
                compact('user_id', 'booking_id')
            );
//            $userBooking = new UserBooking();
//            $userBooking->user_id = $user_id;
//            $userBooking->booking_id = $booking_id;
            try{
                $userBooking->save();
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                dd($e);
            }
        });
    }
}
