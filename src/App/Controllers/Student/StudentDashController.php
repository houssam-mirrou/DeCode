<?php

namespace App\Controllers\Student;

use App\Core\Controller;
use App\Core\Functions;
use App\Services\LivrableService;
use App\Services\SprintServices;

class StudentDashController extends Controller
{
    public function index()
    {
        $sprint_service = SprintServices::get_instance();
        
        $student_id = $_SESSION['current_user']->get_id();
        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences_and_submission($student_id);
        $current_user = $_SESSION['current_user'];
        $this->view('Pages.Dashboards.student', [
            'current_user' => $current_user,
            'sprints' => $sprints
        ]);
    }

    public function submit()
    {
        $sprint_service = SprintServices::get_instance();
        $livrable_service = LivrableService::get_instance();

        $current_user = $_SESSION['current_user'];
        $student_id = $_SESSION['current_user']->get_id();

        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences_and_submission($student_id);

        $brief_id = $_POST['brief_id'];
        $comment = $_POST['comment'];
        $url = $_POST['repo_link'];

        $errors = $livrable_service->insert_livrable($url, $comment, $student_id, $brief_id);

        if ($errors == true) {
            header('Location: /student/dashboard');
            exit();
        } else {
            $this->view('Pages.Dashboards.student', [
                'current_user' => $current_user,
                'sprints' => $sprints,
                'errors' => $errors
            ]);
        }
    }
}
