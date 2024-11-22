<?php
declare(strict_types=1);

namespace App\Services;

use App\Http\JWT;
use App\Models\User;
use App\Utils\Validator;
use Exception;
use PDOException;
use Throwable;

// Realiza a aplicação das regras de negócio sobre os dados, evitando que a controladora fique poluída
class UserService{
    // Recebe somente ids inteiros
    public static function find(mixed $jwt){
        try{
            if(!$jwt) return ["error" => "Sorry, we couldn't authenticate you..."];
            
            // Recebe o token do jwt
            
            $userFromToken = JWT::validateToken($jwt);

            $user = User::find($userFromToken['id_usuario']);
            if(!$user) return ["error" => "Sorry, your data aren't present in our database."];

            return $user;
        }catch(PDOException $e){
            echo "Passei no catch do PDO...";
            return Validator::validatePDO($e->getCode());
            // return Validator::validatePDO($e->getCode());
        } catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
        
        // try{
        //     if(!$authorization) return "Sorry, user can't access this resource.";

        //     return $users = User::fetchAll();

        // } catch(PDOException $e){
        //     echo "Passei no catch do PDO...";
        //     return Validator::validatePDO($e->getCode());
        //     // return Validator::validatePDO($e->getCode());
        // } catch(Exception $e){
        //     return ["error" => $e->getMessage()];
        // }
    }
    
    public static function auth(array $data){
        try{
            $fields = Validator::validate([
                "email" => $data['email'],
                "senha" => $data['senha']
            ]);

            $user = User::auth($fields);

            // dump($user);

            // Verificar depois como enviar erro 401 para usuário não autorizado...
            if(!$user) return "Sorry, we could not authenticate you...";

            return JWT::generate([
                "id_usuario" => $user['id_usuario'],
                "email" => $user['email']
            ]);
        }
        catch(PDOException $e){
            return Validator::validatePDO($e->getCOde());
        } 
        catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
    }

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
            return Validator::validatePDO($e->getCode());
        }
        catch(Exception $e){
            return ["error" => $e->getMessage()];
        }
    }

    public static function update(){

    }


}