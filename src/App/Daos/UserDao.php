<?php

namespace App\Daos;

use App\Core\DataBase;

class UserDao
{
    private $data;
    private static $instance;
    public function __construct()
    {
        $this->data = DataBase::get_instance();
    }
    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get_user($email)
    {
        $query = 'SELECT * from users where email=:email';
        $params = [
            ':email' => $email
        ];
        $result = $this->data->query($query, $params);
        return $result[0];
    }
    public function same_password($email, $password)
    {
        $query = 'SELECT password from users where email = :email;';
        $params = [
            ':email' => $email
        ];
        $result = $this->data->query($query, $params);
        if ($result == []) {
            return false;
        }
        if (password_verify($password, $result[0]['password'])) {
            return true;
        }
    }
    public function email_available($email)
    {
        $email = trim($email);
        $query = 'SELECT email from users where email = :email;';
        $params = [
            ':email' => $email
        ];
        $result = $this->data->query($query, $params);
        if ($result == []) {
            return true;
        }
        return false;
    }
    public function insert_student($first_name,$last_name,$email,$password,$role,$class_id) {
        $query = 'INSERT into users (first_name,last_name,email,password,role,class_id) 
                  values (:first_name,:last_name,:email,:password,:role,:class_id)';
        $params = [
            ':first_name'=>$first_name,
            ':last_name'=>$last_name,
            ':email'=>$email,
            ':password'=>$password,
            ':role'=>$role,
            ':class_id'=>$class_id
        ];
        $result = $this->data->query($query,$params);
        return $result;
    }
    public function insert_admin($first_name,$last_name,$email,$password,$role) {
        $query = 'INSERT into users (first_name,last_name,email,password,role) 
                  values (:first_name,:last_name,:email,:password,:role)';
        $params = [
            ':first_name'=>$first_name,
            ':last_name'=>$last_name,
            ':email'=>$email,
            ':password'=>$password,
            ':role'=>$role,
        ];
        $result = $this->data->query($query,$params);
        return $result;
    }
    public function insert_teacher($first_name,$last_name,$email,$password,$role) {
        $query = 'INSERT into users (first_name,last_name,email,password,role) 
                  values (:first_name,:last_name,:email,:password,:role)';
        $params = [
            ':first_name'=>$first_name,
            ':last_name'=>$last_name,
            ':email'=>$email,
            ':password'=>$password,
            ':role'=>$role,
        ];
        $result = $this->data->query($query,$params);
        return $result;
    }
}
