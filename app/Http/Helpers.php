<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Support\Facades\Route;

class Helpers {
    public static function activeRoute($name, $class){
        $route = Route::currentRouteName();
        $state = "";
        if(is_array($name)){
            foreach ($name as $key => $value) {
                if($value == $route){
                    $state = $class;
                    break;
                }
            }
        } else {
            if($name == $route){
                $state = $class;
            }
        }
        return $state;
    }
}
