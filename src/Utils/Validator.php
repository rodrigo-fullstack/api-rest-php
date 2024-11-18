<?php
declare(strict_types = 1);

namespace App\Utils;

// Serve para validar os dados recebidos
class Validator{
    public static function validate(array $fields){

        // Para cada campo em campos com seu devido valor
        foreach($fields as $field => $value){
            // Se não é vazia e elimina todos os espaços em branco com trim
            if(empty(trim($value))){
                throw new \Exception("The field {$field} is required");
            }
        }

        return $fields;
    }
}