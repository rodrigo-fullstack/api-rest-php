<?php


namespace App\Core;

Class Core{
    // URLs
    public static function dispatch(array $routes){
        print_r(json_encode($routes, JSON_PRETTY_PRINT));
    }
}