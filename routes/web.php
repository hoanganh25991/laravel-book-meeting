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
use App\BookingUser;
use App\Group;
use App\GroupUser;
use App\User;

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
/* ROOM */
Route::get('room/load', function (ApiRequest $req){
    return view('rooms.load');
});

Route::post('room/load', function (ApiRequest $req){
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

Route::get('room', function(ApiRequest $req){
    //load ALL at this point
    /* @warn update precise to userA location/organization */
    //better than just show ALL!!!
    $rooms = Room::all();
    
    return view('rooms.index', compact('rooms'));
});
/* BOOKING */
Route::get('booking/create', function (ApiRequest $req){
    //load rooms to create select-box
    $rooms = Room::all();

    return view('bookings.create', compact('rooms'));
});

Route::post('booking/create', 'BookingController@createBooking');

//Route::get('booking', function (ApiRequest $req){
//    //from user >load> booking
//    //which created_by user
//    $user = User::with(['bookings' => function($query){
//                    $query->where('created_by', Auth::id());
//                }])
//                ->where('id', Auth::id())
//                ->first()
//                ;
////    $bookings = [];
////    if(!empty($user))
////        $bookings = $user->bookings;
//
//    !empty($user) ?
//        $bookings = $user->bookings :
//        $bookings = [];
//
//    return view('bookings.index', compact('bookings'));
//});
Route::get('booking', 'BookingController@loadAllBookings');
/* GROUP */
Route::get('group/create', function (ApiRequest $req){
    return view('groups.create');
});

Route::post('group/create', 'GroupController@createGroup');

Route::get('group', function (ApiRequest $req){
    //list all groups
    //may let user JOIN INTO
    //may let user handle up-on group
    $groups = Group::all();
    return view('groups.index', compact('groups'));
});

Route::get('group/join', function (ApiRequest $req){
    //load group with user > group status
    //join (completely new) | pending (wait for host userA accept)
    $groups = Group::with(['group_user' => function($query){
                            $query->byUser();
                        }])
                        ->get()
                        ;
//    dd($groups);
    $groups->each(function($group){
        $btnTxt = 'join';
        $groupUser = $group->group_user;
//        var_dump($groupUser);
        if(!empty($groupUser)){
            $btnTxt = $groupUser->status;
        }
        $group['btnTxt'] = $btnTxt;
    });

    return view('groups.join', compact('groups'));
});

Route::post('group/join', function (ApiRequest $req){
    $group_id = $req->get('group_id');
    //userB join in group`
    //create a relation group1-userB
    $groupUser = new GroupUser([
        'group_id' => $group_id,
        'user_id' => Auth::id(),
        'status' => 'pending'
    ]);

    $msg = '';
    try{
        $groupUser->save();
        $msg = 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();
        return response($msg, 500, [
            'Content-Type' => 'application/json'
        ]);
    }
    return response()->json(compact('msg'));
});

Route::get('group/verify', function (ApiRequest $req){
    //userA load group1, group2, group3,..
    //load all groups, which userA join-in
    //BUT in each group, just load user != userA
    //AND only load group with status 'pending'
    $groups = Group::with(['users' => function ($query){
                        //no need to load userA
                        $query->where('users.id', '!=', Auth::id());
                    }])
                    ->whereHas('group_user', function($query){
                        //group with status 'pending'
                        //group-user, where userB accepted
                        //no need to load here
                        $query->where('status', 'pending');
                    })
                    /* @warn ONLY load group by userA is WRONG */
//                    ->where('created_by', Auth::id())
//                    ->whereUserAJoinedIn
                    ->whereHas('group_user', function($query){
                        $query->where([
                            ['user_id', Auth::id()],
                            ['status', 'joined']
                        ]);
                    })
                    ->get();
//    dd($groups);
    return view('groups.verify', compact('groups'));
});

Route::post('group/verify', function (ApiRequest $req){
    $user_id = $req->get('user_id');
    $group_id = $req->get('group_id');
    //load groupUser
    //then update status
    //done
    $groupUser = GroupUser::where([
                                ['user_id', '=', $user_id],
                                ['group_id', '=', $group_id]
                            ])
                            ->first()
                            ;
    $groupUser->status = 'joined';

    $msg = '';
    try{
        $groupUser->save();
        $msg .= 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();

        return response($msg, 500, [
            'Content-Type' => 'application/json'
        ]);
    }

    return response()->json(compact('msg'));
});

Route::get('group/{group_id}', function($group_id, ApiRequest $req){
    $group = Group::with('userCreated')
                    ->where('id', $group_id)
                    ->first();
    
    return view('groups.detail', compact('group'));
});
/* BOOKING */
Route::get('booking/{booking}/invite', 'BookingController@inviteTeamMember');

Route::post('booking/{id}/invite', function(ApiRequest $req){
    $user_id = $req->get('user_id');
    $booking_id = $req->get('booking_id');
    $user_booking = new BookingUser([
        'user_id' => $user_id,
        'booking_id' => $booking_id
    ]);

    $msg = '';
    try{
        $user_booking->save();
        $msg .= 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();

        return response($msg, 500, ['Content-Type' => 'application/json']);
    }

    return response($msg, 200, ['Content-Typ' => 'application/json']);
});

/**
 * @warn ONLY allow booking user JOINED
 */
Route::get('booking/{booking}', function(Booking $booking, ApiRequest $req){
//    dd($booking);
    //check user ---related to ---booking
    $bookingUser = BookingUser::where([
                                    ['booking_id', $booking->id],
                                    ['user_id', Auth::id()]
                                ])
                                ->first()
                                ;
//    dd($bookingUser);
    if(empty($bookingUser)){
        return redirect()->route('home');
    }
    
    /* load users related to BOOKING */
    $bookingUsers = BookingUser::with('user')
                                ->where([
                                    ['booking_id', $booking->id],
                                    ['user_id', '!=', Auth::id()]
                                ])
                                ->get();
    
    return view('bookings.detail', compact('booking', 'bookingUsers'));
});