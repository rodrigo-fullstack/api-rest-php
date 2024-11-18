<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class UserController{
    public function login(){
        
    }
    
    public function fetch(){
        
    }
    
    public function save(){
        $body = Request::body();

        Response::json(
            [
            "error" => false,
            "success" => true,
            "data" => $body], 201
        );
    }

    public function update(){
        
    }

    public function delete(Request $request, Response $response, int $id){

    }

}