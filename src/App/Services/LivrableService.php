<?php

namespace App\Services;

use App\Repositories\LivrableRepository;

class LivrableService {
    private $livrable_repository;
    private static $instance;
    private function __construct()
    {
        $this->livrable_repository = LivrableRepository::get_instance();
    }
    public static function get_instance(){
        if(self::$instance==null){
            self::$instance= new self();
        }
        return self::$instance;
    }
    public function insert_livrable($url, $comment, $student_id, $brief_id){
        return $this->livrable_repository->insert_livrable($url, $comment, $student_id, $brief_id);
    }
} 