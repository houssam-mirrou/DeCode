<?php

namespace App\Repositories;

use App\Daos\LivrableDao;

class LivrableRepository
{
    private $livrable_dao;
    private static $instance;
    public function __construct()
    {
        $this->livrable_dao = LivrableDao::get_instance();
    }
    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function insert_livrable($url, $comment, $student_id, $brief_id){
        return $this->livrable_dao->insert_livrable($url, $comment, $student_id, $brief_id);
    } 
}
