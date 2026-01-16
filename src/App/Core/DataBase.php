<?php

namespace App\Core;
use PDO;
use PDOException;

class DataBase {
    private $connection;
    private static $instance;
    private function __construct()
    {
        $config = Config::get_config();
        $username = 'user';
        $password = 'password';
        $dsn = "pgsql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function get_instance(){
        if(self::$instance==null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($query,$params=[]){
        $statement = $this->connection->prepare($query);
        if(!$statement){
            return false;
        }
        $status = $statement->execute($params);
        if(str_starts_with(strtolower(trim($query)),'select')){
            $result = $statement->fetchAll();
            return $result;
        }
        return $status;
    }

    public function get_last_inserted_id_query(){
        $query = 'SELECT LAST_INSERT_ID() as id;';
        $result = $this->query($query);
        return $result[0]['id'];
    }
}