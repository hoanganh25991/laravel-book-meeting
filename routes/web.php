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
    $rooms = $req->get('rooms');
    return json_encode($rooms);
});
