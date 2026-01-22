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
    public function insert_student($first_name, $last_name, $email, $password, $role, $class_id)
    {
        $query = 'INSERT into users (first_name,last_name,email,password,role,class_id) 
                  values (:first_name,:last_name,:email,:password,:role,:class_id)';
        $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role,
            ':class_id' => $class_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function insert_admin($first_name, $last_name, $email, $password, $role)
    {
        $query = 'INSERT into users (first_name,last_name,email,password,role) 
                  values (:first_name,:last_name,:email,:password,:role)';
        $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role,
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function insert_teacher($first_name, $last_name, $email, $password, $role)
    {
        $query = 'INSERT into users (first_name,last_name,email,password,role) 
                  values (:first_name,:last_name,:email,:password,:role)';
        $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role,
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function get_teachers()
    {
        $query = "SELECT * from users where role='teacher'";
        $result = $this->data->query($query);
        return $result;
    }

    public function get_unassigned_teacher()
    {
        $query = "SELECT u.* FROM users u
                    LEFT JOIN teachers_in_class t ON u.id = t.teacher_id
                    WHERE u.role = 'teacher' 
                    AND t.teacher_id IS NULL;";
        $result = $this->data->query($query);
        return $result;
    }
    public function get_teacher_by_id($id)
    {
        $query = "SELECT * from users where id=:id";
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result[0];
    }
    public function gat_assigned_teachers()
    {
        $query = "SELECT * from users u,teachers_in_class t where role='teacher' and u.id==t.teacher_id";
        $result = $this->data->query($query);
        return $result;
    }

    public function get_users_without_current($id)
    {
        $query = "SELECT * FROM users
                    where id!=:id";
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function update_user_with_password($id, $first_name, $last_name, $email, $password, $role, $class_id)
    {
        $query = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, role = :role";

        $params = [
            ':id' => $id,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':role' => $role
        ];

        if (!empty($password)) {
            $query .= ", password = :password";
            $params[':password'] = $password;
        }

        if ($role === 'student') {
            $query .= ", class_id = :class_id";
            $params[':class_id'] = $class_id;
        } else {
            $query .= ", class_id = NULL";
        }

        $query .= " WHERE id = :id";

        return $this->data->query($query, $params);
    }

    public function delete_user_by_id($id)
    {
        $query = 'DELETE from users where id=:id';
        $params = [
            ':id' => $id
        ];
        return $this->data->query($query, $params);
    }

    public function get_teacher_class_id($teacher_id)
    {
        $query = 'SELECT class_id from teachers_in_class where teacher_id=:teacher_id';
        $params = [
            ':teacher_id' => $teacher_id
        ];
        $result = $this->data->query($query, $params);
        return $result[0]['class_id'];
    }

    public function get_class_roster($class_id)
    {
        // We count evaluations where review is 'good' or 'excellent'
        $query = "SELECT 
                u.id, u.first_name, u.last_name, u.email, u.created_date,
                
                -- Count Validated Projects
                (SELECT COUNT(*) FROM evaluation e 
                WHERE e.student_id = u.id 
                AND (e.review = 'good' OR e.review = 'excellent')
                ) as validated_count

            FROM users u
            WHERE u.class_id = :class_id 
            AND u.role = 'student'
            ORDER BY u.last_name ASC
        ";

        // Optional: Get total number of briefs for this class to show progress %
        // For now, we'll just return the students
        return $this->data->query($query, [':class_id' => $class_id]);
    }
}
