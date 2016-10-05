<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Room;
use DB;

class RoomController extends Controller
{
    public function loadGet(){
        return view('rooms.load');
    }
    
    public function loadPost(ApiRequest $req){
        $rooms = json_decode($req->get('rooms'), true);
        $isReloaded = $req->get('reload');
        $msg = 'Load room success';
        try{
//            DB::statement(
//                "SET FOREIGN_KEY_CHECKS = 0;
//                SET AUTOCOMMIT = 0;
//                START TRANSACTION;
//                TRUNCATE TABLE rooms;
//                SET FOREIGN_KEY_CHECKS = 1;
//                COMMIT;
//                SET AUTOCOMMIT = 1 ;"
//            );
            DB::table('rooms')->insert($rooms);
        }catch(\Exception $e){
            $msg = $e->getMessage();
        }
        flash($msg, 'info');

        return redirect('room');
    }

    public function index(ApiRequest $req){
        //load ALL at this point
        /* @warn update precise to userA location/organization */
        //better than just show ALL!!!
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    public function available(ApiRequest $req){
        $start_date = $req->get('start_date');
        $end_date = $req->get('end_date');
        Storage::put('start_date', $start_date);
        Storage::put('end_date', $end_date);
        $rooms = Room::whereDoesntHave('bookings', function($bookingUser){
            $bookingUser->where([
                ['start_date', '<', Storage::get('start_date')],
                ['end_date', '>', Storage::get('start_date')]
            ])->orWhere([
                ['start_date', '<', Storage::get('end_date')],
                ['end_date', '>', Storage::get('end_date')]
            ]);
        })->get();
//        dd($rooms);
        return response($rooms, 200, ['Content-Type' => 'application/json']);
    }
}
