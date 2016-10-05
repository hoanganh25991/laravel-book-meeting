<?php
use App\Http\Requests\ApiRequest;

Route::get('', function (){return view('welcome');});
Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('home', 'HomeController@index')->name('home');
    /* ROOM */
    Route::get('rooms/load', 'RoomController@loadGet');
    Route::post('rooms/load', 'RoomController@loadPost');
    Route::get('rooms', 'RoomController@index');
    Route::post('rooms/available', 'RoomController@available');
    Route::get('rooms/available', 'RoomController@available');
    /* BOOKING */
    Route::get('booking/create', 'BookingController@createGet');
    Route::post('booking/create', 'BookingController@createPost');
    
    Route::get('booking', 'BookingController@loadAllBookings');
    Route::get('booking/{booking}', 'BookingController@detail');
    
    Route::get('booking/{booking}/edit', 'BookingController@editGet');
    Route::post('booking/{booking}/edit', 'BookingController@editPost');
    
    Route::post('booking/{booking}/delete', 'BookingController@delete');
    
    Route::get('booking/{booking}/invite', 'BookingController@inviteTeamMemberGet');
    Route::post('booking/{booking}/invite', 'BookingController@inviteTeamMemberPost');
    
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

    /* SAMPLE */
    Route::get('load-file', function(ApiRequest $req){
        $file_name = $req->get('file_name');
        return response()->download(public_path($file_name));
    });
});
