<?php

namespace App\Services;

use App\Utils\Validator;
use Exception;

// Realiza a aplicação das regras de negócio sobre os dados, evitando que a controladora fique poluída
class UserService{
    public static function save(array $data){
        try{
            // Campos são validados para serem persistidos no bd
            $fields = Validator::validate([
                "email" => $data['email'] ?? '',
                "senha" => $data['senha'] ?? ''
            ]);

            return $fields;
        }catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
    }
}