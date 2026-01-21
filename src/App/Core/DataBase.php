<?php

namespace App\Core;

use PDO;
use PDOException;

class DataBase
{
    private $connection;
    private static $instance;
    private function __construct()
    {
        $config = Config::get_config_database();
        $username = 'user';
        $password = 'password';
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $this->connection->exec("SET NAMES 'UTF8'");
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            return false;
        }
        $status = $statement->execute($params);

        $command = strtolower(trim($query));

        if (str_starts_with($command, 'select') || str_contains($command, 'returning')) {
            $result = $statement->fetchAll(); 
            return $result;
        }
        return $status;
    }

    public function get_last_inserted_id_query()
    {
        $query = 'SELECT LAST_INSERT_ID() as id;';
        $result = $this->query($query);
        return $result[0]['id'];
    }
}
