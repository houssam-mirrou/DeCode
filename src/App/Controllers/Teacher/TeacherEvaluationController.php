<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Functions;
use App\Services\SprintServices;
use App\Services\UserServices;

class TeacherEvaluationController extends Controller {
    public function index() {
        $user_service = UserServices::get_instance();
        $sprint_service = SprintServices::get_instance();
        $class_id = $user_service->get_teacher_class_id($_SESSION['current_user']->get_id());

        $sprints = $sprint_service->get_all_briefs_submitted_by_students($class_id);
        // Functions::dd($sprints);

        $this->view('Pages.Teacher.evaluation',[
            'sprints'=>$sprints
        ]);
    }
}