<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
class Group extends Model
{
    protected $fillable = ['name', 'description'];

    public static function boot(){
        static::created(function($group){
            $userGroup = new GroupUser([
                'group_id' => $group->id,
                'user_id' => Auth::id(),
                'status' => 'joined'
            ]);

            try{
                $userGroup->save();
                DB::commit();
            }catch(\Exception $e){
                DB::rollback();
                dd($e);
            }
        });
    }

    public function group_user(){
        return $this->hasOne(GroupUser::class, 'group_id', 'id');
    }
    
    public function scopeCreatedByUser($query){
        return $query->where('created_by', Auth::id());
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
    
    public function userCreated(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
    public function groupUsers(){
        return $this->hasMany(GroupUser::class, 'group_id', 'id');
    }
    
    public function pivotAtUserX(){
        return $this->hasOne(GroupUser::class, 'group_id', 'id');
    }
}
