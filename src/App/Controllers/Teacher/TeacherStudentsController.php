<?php

namespace App\Controllers\Teacher;

use App\Services\UserServices;

class TeacherStudentsController extends TeacherEvaluationController {
    public function index() {
        $user_service = UserServices::get_instance();
        $class_id = $user_service->get_teacher_class_id($_SESSION['current_user']->get_id());
        $students = $user_service->get_class_roster($class_id);
        $this->view('Pages.Teacher.students',[
            'students' => $students,
            'class_id' => $class_id
        ]);
    }
}