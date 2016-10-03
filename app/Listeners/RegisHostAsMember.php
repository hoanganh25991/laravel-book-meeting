<?php

namespace App\Listeners;

use App\Events\BookingCreated;

use App\BookingUser;
use Auth;

class RegisHostAsMember
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BookingCreated  $event
     * @return void
     */
    public function handle(BookingCreated $event)
    {
        $booking = $event->booking;
      
        $bookingUser = new BookingUser([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'status' => 'joined'
        ]);
        
        try{
            $bookingUser->save();
        }catch(\Exception $e){
            dd($e);
        }
    }
}
