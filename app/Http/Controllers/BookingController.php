<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\ApiRequest;
use App\BookingUser;
use App\Booking;
use Auth;
use App\User;
use App\Room;
use BookingX;
class BookingController extends Controller{
    /*
     * At homepage, user need to load ALL booking
     * 1. which he created
     * 2. which he invited
     */
    public function loadAllBookings(ApiRequest $req){
        //look at booking_user
        //find out where user_id = userA & which userA accepted
        //BookingUser can load booking-info on each success row
        $query = BookingUser::with('booking.createdBy')->where('user_id', Auth::id())->where('status', 'joined');
        $bookings = $query->get()->map(function ($bookingUser){
            return $bookingUser->booking;
        });
        dd($bookings);
    }

    /*
     * Create a booking
     * 1. save new
     * 2. auto join userA into booking_user
     * (this just a default action, userA may create BUT NOT join in the meeting)
     */
    public function createPost(ApiRequest $req){
        $bookingInfo = $req->get('booking');
        $booking = new Booking($bookingInfo);
        $booking->created_by = Auth::id();

        $msg = '';
        try{
            $booking->save();
            //@listener: RegisHostAsMember
            event(new BookingCreated($booking));

            $msg .= 'success';
            flash($msg, 'success');
        }catch(\Exception $e){
            $msg .= $e->getMessage();
            flash($msg, 'warning');
        }

        return redirect()->to(url("booking/{$booking->id}/invite"));
    }

    public function createGet(ApiRequest $req){
        //load rooms to create select-box
        $rooms = Room::all();

        return view('bookings.create', compact('rooms'));
    }

    public function inviteTeamMemberGet(Booking $booking){
        /*
         * from userA, load groups he belongsToMany
         * from each group, load all users, also belongsToMany
         *
         * then filter back status of each user in booking_user
         */
//        app()->bind('BookingX', $booking);
//        Storage::$instance['booking'] = $booking;
        Storage::put('booking', $booking);
        $userA = User::with([
            'groups.users' => function($user){
                $user->with(['pivotAtBookingX' => function ($pivots){
//                    $booking = Storage::$instance['booking'];
                    $booking = Storage::get('booking');
                    $pivots->where('booking_id', $booking->id)->first();
                }])->where('users.id', '!=', Auth::id());
            }])->find(Auth::id());
//        dd($userA);
        $groups = $userA->groups;
//        dd($groups);
//        $groups = $query->get()->groups;
        $groups->each(function ($group){
            $users = $group->users;
            $users->each(function ($user){
//            $users->each(function ($user, $index) use($users){
//                if($user->id == Auth::id()){
//                    unset($users[$index]);
//                }
                $status = 'invite';
                if(!empty($user->pivotAtBookingX)){
                    $status = $user->pivotAtBookingX->status;
                }
//                $user->attributes['booking_status'] = $status;
                $user->booking_status = $status;
            });
        });
        $booking_id = $booking->id;
        return view('bookings.invite')->with(compact('groups', 'booking_id'));
    }

    public function inviteTeamMemberPost(ApiRequest $req){
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
    }

    public function detail(Booking $booking, ApiRequest $req){
//    dd($booking);
        //check user ---related to ---booking
        $bookingUser = BookingUser::where([
            [
                'booking_id',
                $booking->id
            ],
            [
                'user_id',
                Auth::id()
            ]
        ])->first();
//    dd($bookingUser);
        if(empty($bookingUser)){
            return redirect()->route('home');
        }

        /* load users related to BOOKING */
        $bookingUsers = BookingUser::with('user')->where([
            [
                'booking_id',
                $booking->id
            ],
            [
                'user_id',
                '!=',
                Auth::id()
            ]
        ])->get();

        return view('bookings.detail', compact('booking', 'bookingUsers'));
    }
}
