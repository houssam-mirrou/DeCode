<?php
namespace App\Repositories;

use App\Daos\UserDao;
use App\Mappers\UserMapper;

class UserRepository {
    private $userDao;
    private static $instance;
    public function __construct()
    {
        $this->userDao = UserDao::get_instance();
    }
    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function get_user($email){
        $user = $this->userDao->get_user($email);
        $current_user = UserMapper::map_user($user);
        return $current_user;
    }
}