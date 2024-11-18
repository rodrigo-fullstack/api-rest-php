<?php

namespace App\Services;

// Realiza a aplicação das regras de negócio sobre os dados, evitando que a controladora fique poluída
class UserService{
    public static function save(array $data){
        return $data;
    }
}