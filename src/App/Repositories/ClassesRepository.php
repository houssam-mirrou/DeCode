<?php

namespace App\Repositories;

use App\Core\Functions;
use App\Daos\ClassesDao;
use App\Daos\UserDao;
use App\Mappers\ClassesMapper as MappersClassesMapper;
use App\Mappers\UserMapper;
use ClassesMapper;

class ClassesRepository
{
    private $classesDao;
    private $userDao;
    private static $instance;
    private function __construct()
    {
        $this->classesDao = ClassesDao::get_instance();
        $this->userDao = UserDao::get_instance();
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
        return $this->classesDao->insert_class($name, $school_year);
    }

    public function update_class($id, $name, $school_year)
    {
        return $this->classesDao->update_class($id, $name, $school_year);
    }

    public function delete_class($id)
    {
        return $this->classesDao->delete_class($id);
    }

    public function get_all_classes()
    {
        $db_classes = $this->classesDao->get_all_classes();
        $classes = [];
        foreach ($db_classes as $clas) {
            $class = MappersClassesMapper::map_class($clas);
            array_push($classes, $class);
        }
        return $classes;
    }
    public function add_teacher_to_class($class_id, $teacher_id)
    {
        return $this->classesDao->add_teacher_to_class($class_id, $teacher_id);
    }

    public function get_all_classes_with_teachers()
    {
        $db_classes = $this->classesDao->get_all_classes();
        $classes_and_their_teachers[] = [];
        foreach ($db_classes as $clas) {
            $class = MappersClassesMapper::map_class($clas);

            $teacher = null;
            $teacher_id = $this->classesDao->get_teacher_id($clas['id']);
            if ($teacher_id) {
                $db_teacher = $this->userDao->get_teacher_by_id($teacher_id);
                if ($db_teacher) {
                    $teacher = UserMapper::map_teacher($db_teacher);
                }
            }
            $classes_and_their_teachers[] = [
                'class' => $class,
                'teacher' => $teacher 
            ];
        }

        return $classes_and_their_teachers;
    }

    public function remove_teacher_from_class($class_id, $teacher_id){
        return $this->classesDao->remove_teacher_from_class($class_id, $teacher_id);
    }
}
