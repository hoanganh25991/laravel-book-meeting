<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GroupUser extends Model
{
    protected $table = 'group_user';
    protected $fillable = ['group_id', 'user_id', 'status'];
    
    public function scopeByUser($query){
        return $query->where('user_id', Auth::id());
    }
    
    public function user(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    
    public function group(){
        return $this->hasMany(Group::class, 'id', 'group_id');
    }
    
    public function groupByUser(){
        return $this->hasOne(Group::class, 'id', 'group_id')->createdByUser();
    }
}
