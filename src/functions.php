<?php

use Illuminate\Support\Arr;

if(!function_exists('array_get')){
    function array_get($array, $key, $default = null){
        return Arr::get($array, $key, $default = null);
    }
}