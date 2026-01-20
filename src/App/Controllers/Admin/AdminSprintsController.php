<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Services\ClassesServices;
use App\Services\SprintServices;

class AdminSprintsController extends Controller
{
    public function index()
    {
        $class_service = ClassesServices::get_instance();
        $sprint_services = SprintServices::get_instance();
        $sprints = $sprint_services->get_all_sprints();

        $classes = $class_service->get_all_classes();
        $this->view('Pages.Admin.sprints', [
            'classes' => $classes,
            'sprints' => $sprints
        ]);
    }

    public function insert_sprint()
    {
        $class_service = ClassesServices::get_instance();
        $classes = $class_service->get_all_classes();
        $sprint_services = SprintServices::get_instance();
        $sprints = $sprint_services->get_all_sprints();

        $name = $_POST['name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $class_id = $_POST['class_id'];
        $errors = $sprint_services->insert_sprint($name, $start_date, $end_date, $class_id);
        
        if ($errors === true) {
            header('Location: /admin/sprints');
            exit();
        } else {
            $this->view('Pages.Admin.sprints', [
                'errors' => $errors,
                'classes'=>$classes,
                'sprints' => $sprints
            ]);
        }
    }

    public function update_sprint()
    {
        $class_service = ClassesServices::get_instance();
        $classes = $class_service->get_all_classes();
        $sprint_services = SprintServices::get_instance();
        $sprints = $sprint_services->get_all_sprints();

        $sprint_id = $_POST['id'];
        $name = $_POST['name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $class_id = $_POST['class_id'];
        $errors = $sprint_services->update_sprint($sprint_id,$name, $start_date, $end_date, $class_id);
        if ($errors === true) {
            header('Location: /admin/sprints');
            exit();
        } else {
            $this->view('Pages.Admin.sprints', [
                'errors' => $errors,
                'classes'=>$classes,
                'sprints' => $sprints
            ]);
        }
    }

    public function delete_sprint()
    {
        $class_service = ClassesServices::get_instance();
        $classes = $class_service->get_all_classes();
        $sprint_services = SprintServices::get_instance();
        $sprints = $sprint_services->get_all_sprints();

        $sprint_id = $_POST['id'];
        $errors = $sprint_services->delete_sprint($sprint_id);
        if ($errors === true) {
            header('Location: /admin/sprints');
            exit();
        } else {
            $this->view('Pages.Admin.sprints', [
                'errors' => $errors,
                'classes'=>$classes,
                'sprints' => $sprints
            ]);
        }
    }
}
