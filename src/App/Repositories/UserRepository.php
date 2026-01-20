<?php

namespace App\Repositories;

use App\Daos\UserDao;
use App\Mappers\UserMapper;

class UserRepository
{
    private $userDao;
    private static $instance;
    public function __construct()
    {
        $this->userDao = UserDao::get_instance();
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
        $user = $this->userDao->get_user($email);
        $current_user = UserMapper::map_user($user);
        return $current_user;
    }
    public function get_teachers()
    {
        $db_teachers = $this->userDao->get_teachers();
        $teachers = [];
        foreach ($db_teachers as $teach) {
            $teacher = UserMapper::map_teacher($teach);
            array_push($teachers, $teacher);
        }
        return $teachers;
    }
    public function get_unassigned_teacher()
    {
        $db_teachers = $this->userDao->get_unassigned_teacher();
        $teachers = [];
        foreach ($db_teachers as $teach) {
            $teacher = UserMapper::map_teacher($teach);
            array_push($teachers, $teacher);
        }
        return $teachers;
    }
    public function get_teacher_by_id($id)
    {
        return $this->userDao->get_teacher_by_id($id);
    }
    public function get_users_without_current($id)
    {
        $db_users = $this->userDao->get_users_without_current($id);
        $users_array = [];
        foreach ($db_users as $user) {
            array_push($users_array, UserMapper::map_user($user));
        }
        return $users_array;
    }

    public function insert_student($first_name, $last_name, $email, $password, $role, $class_id)
    {
        return $this->userDao->insert_student($first_name, $last_name, $email, $password, $role, $class_id);
    }
    public function insert_admin($first_name, $last_name, $email, $password, $role){
        return $this->userDao->insert_admin($first_name, $last_name, $email, $password, $role);
    }
    public function insert_teacher($first_name, $last_name, $email, $password, $role){
        return $this->userDao->insert_teacher($first_name, $last_name, $email, $password, $role);
    }
    public function update_user_with_password($id, $first_name, $last_name, $email, $password, $role, $class_id){
        return $this->userDao->update_user_with_password($id, $first_name, $last_name, $email, $password, $role, $class_id);
    }
    public function delete_user_by_id($id){
        return $this->userDao->delete_user_by_id($id);
    }
}
