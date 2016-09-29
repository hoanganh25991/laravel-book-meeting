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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('rooms/load', function(){
    return view('rooms.load');
});

Route::post('rooms/load', function(ApiRequest $req){
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

Route::get('booking/create', function(){
    return view('bookings.create');
});

Route::post('booking/create', function(ApiRequest $req){
    $date = $req->get('date');
    $roomId = $req->get('room');
    return $date . $roomId;
});
