<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['id', 'pivot'];

    public static function boot(){
        parent::boot();
    }

    public function createdBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
