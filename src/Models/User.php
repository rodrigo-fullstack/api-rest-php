<?php

namespace App\Models;

use App\Models\Database;

class User{
    public static function save(array $data){
        // Com conexão estática e o pdo acessível internamente nos métodos
        Database::query("
            INSERT INTO usuario(email, senha)
            VALUES(:email, :senha)
        ");

        Database::bind(':email', $data['email']);
        Database::bind(':senha', $data['senha']);

        Database::execute();
    }
}