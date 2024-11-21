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
                "senha" => $data['senha'] ?? ''
            ]);

            $fields['senha'] = password_hash($fields['senha'], PASSWORD_BCRYPT);
            // Cadastro do dado, retorna se houve inserção ou não
            // Caso houve erro no pdo, gera erro no catch
            $user = User::save($fields);

            // dump($user);

            if(!$user) return "Sorry, User has not been created...";
            
            return "User has been created succesfully";
        }
        catch(PDOException $e){
            echo "Passei no catch do PDO...";
            
            return Validator::validatePDO($e->getCode());
        }
        catch(Exception $e){
            echo "Passei no catch da Exception...";
            // Corrigido código 201 para quando não recebe senha ou email válido
            return ["error" => $e->getMessage()];
        }
    }

    public static function update(){

    }

    
}