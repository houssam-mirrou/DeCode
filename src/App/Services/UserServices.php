<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserServices
{
    private $user_repository;
    private static $instance;
    private function __construct()
    {
        $this->user_repository = UserRepository::get_instance();
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
        return $this->user_repository->get_user($email);
    }

    public function get_teachers()
    {
        return $this->user_repository->get_teachers();
    }

    public function get_unassigned_teacher()
    {
        return $this->user_repository->get_unassigned_teacher();
    }

    public function gat_assigned_teachers()
    {
        return $this->user_repository->gat_assigned_teachers();
    }

    public function get_teacher_by_id($id)
    {
        return $this->user_repository->get_teacher_by_id($id);
    }

    public function get_users_without_current($id)
    {
        return $this->user_repository->get_users_without_current($id);
    }

    public function insert_student($first_name, $last_name, $email, $password, $role, $class_id)
    {
        $errors = [];
        if (empty($first_name)) {
            $errors['first_name'] = 'The first name must have carachters';
        }
        if (empty($last_name)) {
            $errors['last_name'] = 'The last name must have carachters';
        }
        if (empty($email)) {
            $errors['email'] = 'The email must be valid';
        }
        if (empty($password)) {
            $errors['password'] = 'The password must have carachters';
        }
        if (!empty($errors)) {
            return $errors;
        }
        $role = strtolower($role);
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $this->user_repository->insert_student($first_name, $last_name, $email, $password, $role, $class_id);
    }

    public function insert_admin($first_name, $last_name, $email, $password, $role)
    {
        $errors = [];
        if (empty($first_name)) {
            $errors['first_name'] = 'The first name must have carachters';
        }
        if (empty($last_name)) {
            $errors['last_name'] = 'The last name must have carachters';
        }
        if (empty($email)) {
            $errors['email'] = 'The email must be valid';
        }
        if (empty($password)) {
            $errors['password'] = 'The password must have carachters';
        }
        if (!empty($errors)) {
            return $errors;
        }
        $role = strtolower($role);
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $this->user_repository->insert_admin($first_name, $last_name, $email, $password, $role);
    }
    public function insert_teacher($first_name, $last_name, $email, $password, $role)
    {
        $errors = [];
        if (empty($first_name)) {
            $errors['first_name'] = 'The first name must have carachters';
        }
        if (empty($last_name)) {
            $errors['last_name'] = 'The last name must have carachters';
        }
        if (empty($email)) {
            $errors['email'] = 'The email must be valid';
        }
        if (empty($password)) {
            $errors['password'] = 'The password must have carachters';
        }
        if (!empty($errors)) {
            return $errors;
        }
        $role = strtolower($role);
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $this->user_repository->insert_teacher($first_name, $last_name, $email, $password, $role);
    }

    public function update_user_with_password($id, $first_name, $last_name, $email, $password, $role, $class_id)
    {
        $errors = [];
        if (empty($first_name)) {
            $errors['first_name'] = 'The first name must have carachters';
        }
        if (empty($last_name)) {
            $errors['last_name'] = 'The last name must have carachters';
        }
        if (empty($email)) {
            $errors['email'] = 'The email must be valid';
        }
        if (!empty($errors)) {
            return $errors;
        }
        $role = strtolower($role);
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        return $this->user_repository->update_user_with_password($id, $first_name, $last_name, $email, $password, $role, $class_id);
    }

    public function delete_user_by_id($id){
        return $this->user_repository->delete_user_by_id($id);
    }
}
