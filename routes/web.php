<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Http\Requests\ApiRequest;
use App\Room;
use App\Booking;
use App\UserBooking;

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('rooms/load', function (){
    return view('rooms.load');
});

Route::post('rooms/load', function (ApiRequest $req){
    $rooms = json_decode($req->get('rooms'), true);

    $msg = '';
    try{
        DB::table('rooms')->insert($rooms);
        $msg .= 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();
    }

    return $msg;
});

Route::get('booking/create', function (){
    $rooms = Room::all();
    return view('bookings.create', compact('rooms'));
});

Route::post('booking/create', function (ApiRequest $req){
    $bookingInfo = $req->get('booking');
    $booking = new Booking($bookingInfo);
    $booking->created_by = Auth::id();

    $msg = '';
    try{
        $booking->save();
        $msg .= 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();
    }

    return $msg;
});

Route::get('booking', function (){
    $userBookings = UserBooking::with('bookings')
                        ->where('user_id', Auth::id())
                        ->first();
    $bookings = $userBookings->bookings;
    return view('bookings.index', compact('bookings'));
});

Route::get('invite', function (){
    return view('invite');
});
