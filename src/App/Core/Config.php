<?php

namespace App\Core;

class Config
{
    public static function get_config()
    {
        return [
            'database' => [
                'host' => 'db',
                'port' => 5432,
                'dbname' => 'brief_db',
                'charset' => 'utf8'
            ]
        ];
    }
    public static function get_config_database()
    {
        return [
            'host' => 'db',
            'port' => 5432,
            'dbname' => 'brief_db',
            'charset' => 'utf8'
        ];
    }
}
