<?php

namespace App\Daos;

use App\Core\DataBase;

class ClassesDao
{
    private $data;
    private static $instance;
    private function __construct()
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

    public function insert_class($name, $school_year)
    {
        $query = 'INSERT into class (name,school_year) values (:name,:school_year)';
        $params = [
            ':name' => $name,
            ':school_year' => $school_year
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function update_class($id, $name, $school_year)
    {
        $query = 'UPDATE class set name=:name ,school_year=:school_year where id=:id';
        $params = [
            ':name' => $name,
            ':school_year' => $school_year,
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function delete_class($id)
    {
        $query = 'DELETE from class where id=:id';
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function get_all_classes()
    {
        $query = 'SELECT * from class;';
        $result = $this->data->query($query);
        return $result;
    }

    public function add_teacher_to_class($class_id, $teacher_id)
    {
        $query = 'INSERT into teachers_in_class (class_id,teacher_id) values (:class_id,:teacher_id)';
        $params = [
            ':class_id' => $class_id,
            ':teacher_id' => $teacher_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function get_teacher_id($class_id)
    {
        $query = 'SELECT teacher_id from teachers_in_class where class_id=:class_id';
        $params = [
            ':class_id' => $class_id
        ];
        $result = $this->data->query($query, $params);
        if (is_array($result) && count($result) > 0) {
            return $result[0]['teacher_id'];
        }
        
        return null;
    }
    public function remove_teacher_from_class($class_id, $teacher_id){
        $query = 'DELETE from teachers_in_class where class_id=:class_id and teacher_id=:teacher_id';
        $params = [
            ':class_id' => $class_id,
            ':teacher_id' => $teacher_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
}
