<?php

namespace App\Http\Controllers;

use App\Events\BookingCreated;
use App\Http\Requests\ApiRequest;
use App\BookingUser;
use App\Booking;
use Auth;
use App\User;
use App\Room;

class BookingController extends Controller
{
    /*
     * At homepage, user need to load ALL booking
     * 1. which he created
     * 2. which he invited
     */
    public function loadAllBookings(ApiRequest $req){
        //look at booking_user
        //find out where user_id = userA & which userA accepted
        //BookingUser can load booking-info on each success row
        $query = BookingUser::with('booking.createdBy')
                    ->where('user_id', Auth::id())
                    ->where('status', 'joined')
                    ;
        $bookings = $query->get()->map(function($bookingUser){
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

    public function inviteTeamMemberGet(Booking $booking, ApiRequest $req){
        /*
         * load all team member from group which this guide joined in
         */
//        $booking_id = $booking->id;
//        $groups = Group::with(['users' => function($query) use($booking_id){
//            $query->notInvited($booking_id);
//        }])
//            ->whereHas('group_user', function($query){
//                $query->where([
//                    ['user_id', Auth::id()],
//                    ['status', 'joined']
//                ]);
//            })
//            ->get()
//        ;
//
//        return view('bookings.invite', compact('groups', 'booking_id'));
        /*
         * from userA, load groups he belongsToMany
         * from each group, load all users, also belongsToMany
         *
         * then filter back status of each user in booking_user
         */
        $query = User::with(['groups.users.bookings' => function($bookings) use($booking){
                        $bookings->wherePivot('booking_id', '=', $booking->id)->withPivot('status')->first();
                    }])
                    ->where('id', Auth::id())
                    ->first()
                    ;
        $groups = $query->get();
        dd($groups);
//        $groups = $query->get()->groups;
        $groups->map(function($group){
            $users = $group->users;
            $users->map(function($user){
                $status = 'invite';
                if(!empty($user->bookings)){
                    $status = $user->bookings->pivot->status;
                    return;
                }
                $user->attributes['booking_status'] = $status;
            });
        });
        dd($groups);
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
    }
}