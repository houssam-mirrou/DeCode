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
}