<?php

use Illuminate\Support\Facades\Route;

if(!function_exists('isActive')){

    function isActive(array|string $routeName, string $className = 'active'){
        if(is_array($routeName)){
            return in_array(Route::currentRouteName(), $routeName) ? $className : '';
        }

        return Route::currentRouteName() == $routeName ? $className : '';
    }

}