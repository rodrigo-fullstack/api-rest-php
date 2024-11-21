<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Utils\Validator;
use Exception;
use PDOException;
use Throwable;

// Realiza a aplicação das regras de negócio sobre os dados, evitando que a controladora fique poluída
class UserService{
    public static function save(array $data){
        try{
            // Campos são validados para serem persistidos no bd
            // Envia senha criptografada para o validator
            $fields = Validator::validate([
                "email" => $data['email'] ?? '',
                "senha" => password_hash($data['senha'], PASSWORD_BCRYPT) ?? ''
            ]);

            // Cadastro do dado, retorna se houve inserção ou não
            // Caso houve erro no pdo, gera erro no catch
            $user = User::save($fields);

            // dump($user);

            if(!$user) return "Sorry, User has not been created...";
            
            return "User has been created succesfully";
        }
        catch(PDOException $e){
            echo "Passei no catch do PDO...";
            $dsnError = "There was an error with your PDO...";
            $sintaxError = "There was an error with your SQL Sintax... ";
            $errorToJson = match($e->getCode()){
                2002 => ["error" => "$dsnError It can be your dsn host or db port."],
                1049 => ["error" => "$dsnError It can be your dbname."],
                "42S02" => ["error" => "$sintaxError It can be your table name."],
                "42000" => ["error" => "$sintaxError It can be your sql statement."],
                "42S22" => ["error" => "$sintaxError It can be your table attributes that aren't correct"],
                "HY093" => ["error" => "$sintaxError It can be a problem with the param's binding"],
                "23000" => ["error" => "Problem with the sent value, maybe it was null or repeat of an unique key"],
                $e->getCode() => ["error" => "Code error: {$e->getCode()}" ]

            };
            return $errorToJson;
        }
        catch(Exception $e){
            echo "Passei no catch da Exception...";
            return $e->getMessage();
        }
    }
}