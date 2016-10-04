<?php
Route::get('/', function (){return view('welcome');});
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('home', 'HomeController@index')->name('home');
    /* ROOM */
    Route::get('room/load', 'RoomController@loadGet');
    Route::post('room/load', 'RoomController@loadPost');
    Route::get('room', 'RoomController@index');
    /* BOOKING */
    Route::get('booking/create', 'BookingController@createGet');
    Route::post('booking/create', 'BookingController@createPost');
    Route::get('booking', 'BookingController@loadAllBookings');
    Route::get('booking/{booking}/invite', 'BookingController@inviteTeamMemberGet');
    Route::post('booking/{booking}/invite', 'BookingController@inviteTeamMemberPost');
    Route::get('booking/{booking}', 'BookingController@detail');
    Route::get('booking/verify', 'BookingController@inviteVerifyGet');
    Route::post('booking/verify', 'BookingController@inviteVerifyPost');

    /* GROUP */
    Route::get('group/create', 'GroupController@createGroupGet');
    Route::post('group/create', 'GroupController@createGroup');
    Route::get('group', 'GroupController@index');
    Route::get('group/join', 'GroupController@joinGet');
    Route::post('group/join', 'GroupController@joinPost');
    Route::get('group/verify', 'GroupController@verifyGet');
    Route::post('group/verify', 'GroupController@verifyPost');
    Route::get('group/{group_id}', 'GroupController@detail');
});
