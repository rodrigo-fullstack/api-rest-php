<?php


namespace App\Http;

Class Request{
    public static function method(){
        return $_SERVER['REQUEST_METHOD'];
    }
}