<?php

namespace App\Controllers\Student;

use App\Core\Controller;
use App\Core\Functions;
use App\Repositories\BriefRepository;
use App\Services\BriefService;
use App\Services\SprintServices;

class StudentBriefController extends Controller {
    public function index($id) {
        $brief_service = BriefService::get_instance();
        $sprint_service = SprintServices::get_instance();
        $student_id = $_SESSION['current_user']->get_id();
        
        $current_brief = $brief_service->get_brief_by_id($id);
        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences_and_submission($student_id);
        
        $brief = $sprints[$current_brief->get_sprint_id()]['briefs'][$id];
        $sprint = $sprint_service->get_sprint_by_id($current_brief->get_sprint_id());
        

        //Functions::dd($brief);

        $this->view('Pages.Student.brief',[
            'brief'=>$brief,
            'sprint'=>$sprint
        ]);
    }
}