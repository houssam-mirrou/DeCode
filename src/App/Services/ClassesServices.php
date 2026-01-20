<?php

namespace App\Services;

use App\Repositories\ClassesRepository;

class ClassesServices
{
    private $classes_repository;
    private static $instance;
    private function __construct()
    {
        $this->classes_repository = ClassesRepository::get_instance();
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
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'The class should have a name';
        }
        if (empty($school_year)) {
            $errors['school_year'] = 'The class should have a year';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return $this->classes_repository->insert_class($name, $school_year);
    }

    public function update_class($id, $name, $school_year)
    {
        return $this->classes_repository->update_class($id, $name, $school_year);
    }

    public function delete_class($id)
    {
        return $this->classes_repository->delete_class($id);
    }

    public function get_all_classes()
    {
        return $this->classes_repository->get_all_classes();
    }

    public function add_teacher_to_class($class_id, $teachers_id)
    {
        foreach ($teachers_id as $teacher_id) {
            return $this->classes_repository->add_teacher_to_class($class_id, $teacher_id);
        }
    }

    public function get_all_classes_with_teachers()
    {
        return $this->classes_repository->get_all_classes_with_teachers();
    }

    public function remove_teacher_from_class($class_id, $teacher_id)
    {
        return $this->classes_repository->remove_teacher_from_class($class_id, $teacher_id);
    }

    public function add_one_teacher_to_class($class_id, $teacher_id)
    {
        return $this->classes_repository->add_teacher_to_class($class_id,$teacher_id);   
    }

}
