<?php

namespace App\Controllers;

use App\Daos\UserDao;

class AuthController {
    private static $instance;
    private $user_dao;
    private function __construct()
    {
        $this->user_dao = UserDao::get_instance();
    }

    public static function get_instance(){
        if(self::$instance==null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function sign_in($email, $password)
    {
        $errors = [];

        if (!$this->validate_email($email)) {
            $errors['email'] = 'This email is invalid';
        }
        if ($this->user_dao->email_available($email)) {
            $errors['email'] = 'There\'s no account with this email.';
        }

        if (!$this->user_dao->same_password($email,$password)) {
            $errors['password'] = 'Incorrect password.';
        }
        if (empty($errors)) {
            return true;
        }
        return $errors;
    }
    private function validate_email($email)
    {
        $email = trim($email);
        if ($email === null) {
            return false;
        }
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
}