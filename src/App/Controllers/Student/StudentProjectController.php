<?php

namespace App\Controllers\Student;

use App\Core\Controller;
use App\Services\SprintServices;

class StudentProjectController extends Controller
{
    public function index()
    {
        $sprint_service = SprintServices::get_instance();
        $student_id = $_SESSION['current_user']->get_id();
        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences_and_submission($student_id);
        $current_user = $_SESSION['current_user'];
        $this->view('Pages.Student.project', [
            'current_user' => $current_user,
            'sprints' => $sprints
        ]);

    }
}
