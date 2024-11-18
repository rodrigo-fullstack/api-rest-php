<?php


namespace App\Models;

use App\Config\Config;
use PDO;
use PDOException;

class Database{
    private static $db_host = Config::DB_HOST;
    private static $db_user = Config::DB_USER;
    private static $db_pass = Config::DB_PASS;
    private static $db_port = Config::DB_PORT;
    private static $db_name = Config::DB_NAME;


    private static $dbh;
    private static $stmt;
    private static $error;

    public static function getConnection(){
        $dsn = "mysql:host= " . self::$db_host . ";dbname=" . self::$db_name . ";port=" . self::$db_port;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ];

        try{
            // Armazenando conexão
            self::$dbh = new PDO($dsn, self::$db_user, self::$db_pass, $options);

        } catch(PDOException $e){
            self::$error = $e->getMessage();
            // Enviando erro
            return self::$error;
        }
    }

    public static function query($sql){
        // Se estiver definida a conexão...
        if(isset(self::$dbh)){
            // Prepara
            self::$stmt = self::$dbh->prepare($sql);
        }

    }

    public static function execute(){
        // Se estiver definido o statement...
        if(isset(self::$stmt)){
            // Executa
            self::$stmt->execute();
        }
        
    }

    // Vincula no Statement
    public static function bind($param, $value){
        if(isset(self::$stmt)){
            self::$stmt->bindValue($param, $value);
        }

    }

    // Recupera 1 resultado...
    public static function fetchOne(){
        if(isset(self::$stmt)){
            self::$stmt->fetch();
        }

    }

    // Recupera Todos...
    public static function fetchAll(){
        if(isset(self::$stmt)){
            self::$stmt->fetchAll();
        }

    }
}