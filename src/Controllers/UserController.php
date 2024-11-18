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
    
    public function save(Request $request, Response $response){
        // Escuta pelo envio de requisições de body
        $body = $request::body();

        // Dados para serem cadastrados são enviados para o service para serem verificados
        $usrServ = UserService::save($body);

        if(isset($usrServ['error'])){
            // Erro 400 houve erro na requisição (BAD_REQUEST)
            return $response::json([
                "error" => true,
                "success" => false,
                "message" => $usrServ['error']
            ], 400);
        }

        // Status 201 determina que foi criado novo recurso com sucesso
        $response::json(
            [
            "error" => false,
            "success" => true,
            "message" => "User created succesfully",
            "data" => $usrServ], 
            201
        );
    }

    public function update(){
        
    }

    public function delete(Request $request, Response $response, int $id){

    }

}