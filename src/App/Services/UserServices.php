<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserServices {
    private $user_repository;
    private static $instance;
    private function __construct()
    {
        $this->user_repository = UserRepository::get_instance();
    }
    public static function get_instance(){
        if(self::$instance==null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function get_user($email){
        return $this->user_repository->get_user($email);
    }

    public function get_teachers(){
        return $this->user_repository->get_teachers();
    }

    public function get_unassigned_teacher(){
        return $this->user_repository->get_unassigned_teacher();
    }

    public function gat_assigned_teachers(){
        return $this->user_repository->gat_assigned_teachers();
    }

    public function get_teacher_by_id($id){
        return $this->user_repository->get_teacher_by_id($id);
    }

}