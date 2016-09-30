<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'address', 'locate', 'description'];

    protected $hidden = ['id'];
}
