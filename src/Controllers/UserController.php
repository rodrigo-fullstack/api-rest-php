<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;

class UserController{
    public function login(){
        
    }
    
    public function fetch(){
        
    }
    
    public function save(){
        $body = Request::body();

        $usrServ = UserService::save($body);

        Response::json(
            [
            "error" => false,
            "success" => true,
            "data" => $usrServ], 
            201
        );
    }

    public function update(){
        
    }

    public function delete(Request $request, Response $response, int $id){

    }

}