<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ApiRequest;
use Auth;
use App\Group;


class GroupController extends Controller
{
    public function createGroup(ApiRequest $req){
        $groupInfo = $req->get('group');
        $group = new Group($groupInfo);
        $group->created_by = Auth::id();

        $msg = '';
        try{
            $group->save();
            $msg .= 'success';
        }catch(\Exception $e){
            $msg .= $e->getMessage();
        };

        return $msg;
    }
}
