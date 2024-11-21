<?php

namespace App\Models;

use App\Models\Database;
use PDOException;
use Throwable;

class User{
    public static function fetchAll(){
        $bd = new Database();

        $bd->getConnection();

        $bd->query("SELECT * FROM usuario");

        $bd->execute();

        // dump($bd->fetchAll());

        // Retorna um array contendo todos os elementos...
        return $bd->fetchAll();
    }

    public static function save($data){
        $bd = new Database();
        
        // Realiza a conexão pelo dbh do db e retorna como valor true ou uma mensagem de erro
        $bd->getConnection();

        // Se houve a conexão...
        // Aceita objeto como condição para ser aceita...
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

    
    // É importante passar o ID pelo JWT...
    // public static function update($data){
    //     $bd = new Database();

    //     $bd->getConnection();

    //     $stmt = $bd->query("UPDATE FROM usuario SET email = :email, senha = :senha WHERE id = :id");

    //     $bd->execute();

    //     return $stmt->rowCount();
    // }
}