<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Functions;
use App\Services\ClassesServices;
use App\Services\UserServices;

class AdminClassesController extends Controller {
    public function index() {
        $classes_services = ClassesServices::get_instance();
        $user_services = UserServices::get_instance();
        $classes = $classes_services->get_all_classes();
        
        $teachers_unassigned = $user_services->get_unassigned_teacher();
        $class_with_teachers = $classes_services->get_all_classes_with_teachers();
        $this->view('Pages.Admin.classes',[
            'classes'=>$classes,
            'teachers'=>$teachers_unassigned,
            'class_with_teachers'=>$class_with_teachers
        ]);
    }

    public function add_class(){
        $classes_services = ClassesServices::get_instance();
        $name = $_POST['name'];
        $school_year = $_POST['school_year'];
        $errors = $classes_services->insert_class($name,$school_year);
        if($errors === true){
            header('Location: /admin/classes');
            exit();
        }
        else {
            $this->view('Pages.Admin.classes',[
                'errors'=>$errors
            ]);
        }
        
    }
    public function delete_class() {
        $classes_services = ClassesServices::get_instance();
        $id = $_POST['id'];
        $errors = $classes_services->delete_class($id);
        if($errors === true){
            header('Location: /admin/classes');
            exit();
        }
        else {
            $this->view('Pages.Admin.classes',[
                'errors'=>$errors
            ]);
        }
    } 
    public function update_class(){
        $classes_services = ClassesServices::get_instance();
        $id = $_POST['id'];
        $name = $_POST['name'];
        $school_year = $_POST['school_year'];
        $errors = $classes_services->update_class($id,$name,$school_year);
        if($errors === true){
            header('Location: /admin/classes');
            exit();
        }
        else {
            $this->view('Pages.Admin.classes',[
                'errors'=>$errors
            ]);
        }
    }

    public function assign_teacher(){
        $classes_services = ClassesServices::get_instance();        
        $class_id = $_POST['class_id'];
        $teachers_ids = $_POST['teachers'];
        $errors = $classes_services->add_teacher_to_class($class_id,$teachers_ids);
        if($errors === true){
            header('Location: /admin/classes');
            exit();
        }
        else {
            $this->view('Pages.Admin.classes',[
                'errors'=>$errors
            ]);
        }
    }

    public function remove_teacher() {
        $classes_services = ClassesServices::get_instance();
        $class_id = $_POST['class_id'];
        $teacher_id = $_POST['teacher_id'];
        $errors = $classes_services->remove_teacher_from_class($class_id,$teacher_id);
        if($errors === true){
            header('Location: /admin/classes');
            exit();
        }
        else {
            $this->view('Pages.Admin.classes',[
                'errors'=>$errors
            ]);
        }
    }
}