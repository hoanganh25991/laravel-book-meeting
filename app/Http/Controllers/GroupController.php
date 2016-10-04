<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ApiRequest;
use Auth;
use App\Group;
use App\GroupUser;

class GroupController extends Controller
{
    public function createGroup(ApiRequest $req){
        $groupInfo = $req->get('group');
        $group = new Group($groupInfo);
        $group->created_by = Auth::id();

        $group->save();

        flash("<strong>{$group->name}</strong>-group: created", 'success');
//        return redirect()->back();
        return redirect()->to('group');
    }

    public function createGroupGet(ApiRequest $req){
        return view('groups.create');
    }

    public function index(){
        //list all groups
        //may let user JOIN INTO
        //may let user handle up-on group
        $groups = Group::with(['pivotAtUserX' => function($groupUser){
            $groupUser->where('user_id', Auth::id());
        }])->get();
        $groups->each(function($group){
            $user_status = 'join';
            $pivot = $group->pivotAtUserX;
            if(!empty($pivot))
                $user_status = $pivot->status;
//            $group->attributes['status'] = $status;
            $group->user_status = $user_status;
            unset($group->pivotAtUserX);
        });
        return view('groups.index', compact('groups'));
    }
    
    public function joinGet(ApiRequest $req){
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
    }
    
    public function joinPost(ApiRequest $req){
        $group_id = $req->get('group_id');
        //userB join in group`
        //create a relation group1-userB
        $groupUser = new GroupUser([
            'group_id' => $group_id,
            'user_id' => Auth::id(),
            'status' => 'pending'
        ]);

        $groupUser->save();

        return response()->json(['msg' => "success"]);
    }
    
    public function verifyGet(ApiRequest $req){
        //userA load group1, group2, group3,..
        //load all groups, which userA join-in
        //BUT in each group, just load user != userA
        //AND only load group with status 'pending'
//        $groups = Group::with(['users' => function ($query){
//            //no need to load userA
//            $query->where('users.id', '!=', Auth::id());
//        }])
//            ->whereHas('group_user', function($query){
//                //group with status 'pending'
//                //group-user, where userB accepted
//                //no need to load here
//                $query->where('status', 'pending');
//            })
//            /* @warn ONLY load group by userA is WRONG */
////                    ->where('created_by', Auth::id())
////                    ->whereUserAJoinedIn
//            ->whereHas('group_user', function($query){
//                $query->where([
//                    ['user_id', Auth::id()],
//                    ['status', 'joined']
//                ]);
//            })
//            ->get();
//    dd($groups);
        $groups = Group::with(['users' => function($user){
            $admin_id = Auth::id();
            $user->withPivot('status')->notAdmin($admin_id);
        }])
        ->where('created_by', Auth::id())->get();

        $groups->each(function($group){
            $users = $group->users;
            $users->each(function($user){
//                $status = 'accept';
//                if(!empty($user->pivot->status)){
//                    $status = $user->pivot->status;
//                }
                $status = $user->pivot->status;
                if($status == 'pending')
                    $status = 'accept';
                $user->group_status = $status;
            });
        });
//        dd($groups);
        return view('groups.verify', compact('groups'));
    }
    
    public function verifyPost(ApiRequest $req){
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
    }
    
    public function detail($group_id, ApiRequest $req){
        $group = Group::with('userCreated')
            ->where('id', $group_id)
            ->first();

        return view('groups.detail', compact('group'));
    }
}
