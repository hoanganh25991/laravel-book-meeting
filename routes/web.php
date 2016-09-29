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
        DB::beginTransaction();
        $booking->save();
        $msg .= 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();
    }

    return $msg;
});

Route::get('booking', function (){
    $user = User::with(['bookings' => function($query){
                    $query->where('created_by', Auth::id());
                }])
                ->where('id', Auth::id())
                ->first()
                ;
    !empty($user) ?
        $bookings = $user->bookings :
        $bookings = [];

    return view('bookings.index', compact('bookings'));
});

Route::get('group/create', function (){
    return view('groups.create');
});

Route::post('group/create', function (ApiRequest $req){
    $groupInfo = $req->get('group');
    $group = new Group($groupInfo);
    $group->created_by = Auth::id();

    $msg = '';
    try{
        DB::beginTransaction();
        $group->save();
        $msg .= 'success';
    }catch(\Exception $e){
        $msg .= $e->getMessage();
    };

    return $msg;
});

Route::get('group', function (){
    $groups = Group::all();
    return view('groups.index', compact('groups'));
});

Route::get('group/join', function (){
    $groups = Group::with('group_user')->get();
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

/**
 * [+] improve pending click > group_user create second row
 */
Route::post('group/join', function (ApiRequest $req){
    $group_id = $req->get('group_id');
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

Route::get('group/verify', function (){
    //HOW TO ONLY LOAD GROUP as status 'pending'
    $groups = Group::with(['users' => function ($query){
                        $query->where('users.id', '!=', Auth::id());
                    }])
                    ->whereHas('group_user', function($query){
                        $query->where('status', 'pending');
                    })
                    ->where('created_by', Auth::id())
                    ->get();
//    dd($groups);
    return view('groups.verify', compact('groups'));
});

Route::post('group/verify', function (ApiRequest $req){
    $user_id = $req->get('user_id');
    $group_id = $req->get('group_id');
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

Route::get('booking/{id}/invite', function($booking_id){
//    dd($booking_id);
    $groups = Group::with(['users' => function($query) use($booking_id){
//                            $query->whereDoesntHave('bookings');
//                            $bookingsDifA = function($query)use($booking_id){
//                                $query->where('id', '!=', $booking_id);
//                            };
////                            Clouser::bind($bookingsDifA, null, Group::class);
//                            $query->where('users.id', '!=', Auth::id())
//                                    ->has('bookings', $bookingsDifA);
//                            $query->has('bookings', function($query) use ($booking_id){
//                                $query->where('id', '!=', $booking_id);
//                            });

                            $query->notInvited($booking_id);
                        }])
                        ->whereHas('group_user', function($query){
                            $query->where([
                                ['user_id', Auth::id()],
                                ['status', 'joined']
                            ]);
                        })
                        ->get()
                        ;
//    $groups-
    
    return view('bookings.invite', compact('groups', 'booking_id'));
});

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