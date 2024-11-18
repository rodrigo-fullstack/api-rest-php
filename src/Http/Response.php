<?php


namespace App\Http;

Class Response{
    
    public static function json($data = [], $status = 200, $headers){
        http_response_code($status);
        
        header('Content-type-application: application/json');

        echo json_encode($data);
    }

}