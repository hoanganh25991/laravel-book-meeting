<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class Storage{
    public static $instance = [];

    public static function put($key, $value){
        Storage::$instance[$key] = $value;
    }
    
    public static function get($key){
        return isset(Storage::$instance[$key])?
                    Storage::$instance[$key]:
                    null;
    }
}
