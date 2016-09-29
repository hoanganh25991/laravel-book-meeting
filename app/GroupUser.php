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
}
