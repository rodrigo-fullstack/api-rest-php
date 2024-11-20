<?php

namespace App\Models;

use App\Models\Database;

class User{
    public static function save($data){
        $bd = new Database();
        
        // Consulta de inserção...
        $bd->query("
            INSERT INTO usuario(email, senha)
            VALUES(:email, :senha)
        ");

        // Vincula os parâmetros determinados na inserção
        $bd->bind(':email', $data['email']);
        $bd->bind(':senha', $data['senha']);

        // Execução da consulta
        $bd->execute();

        // Retorna se houve última inserção de ID, caso contrário é um false
        return $bd->lastInsertId();
    }
}