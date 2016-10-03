<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Room;

class RoomController extends Controller
{
    public function loadGet(ApiRequest $req){
        return view('rooms.load');
    }
    
    public function loadPost(ApiRequest $req){
        $rooms = json_decode($req->get('rooms'), true);

        $msg = '';
        try{
            DB::table('rooms')->insert($rooms);
            $msg .= 'success';
        }catch(\Exception $e){
            $msg .= $e->getMessage();
        }

        return $msg;
    }

    public function index(ApiRequest $req){
        //load ALL at this point
        /* @warn update precise to userA location/organization */
        //better than just show ALL!!!
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }
}
