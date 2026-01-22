<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Functions;
use App\Services\EvaluationService;
use App\Services\SprintServices;

class TeacherEvaluationBriefController extends Controller
{
    public function index($brief_id, $student_id) {
        $sprint_service = SprintServices::get_instance();
        $brief_info = $sprint_service->get_student_evaluation_data($brief_id, $student_id);
        // Functions::dd($brief_info);
        $this->view('Pages.Teacher.eval_brief',[
            'dto'=>$brief_info
        ]);
    }

    public function evaluate(){
        $evaluation_service = EvaluationService::get_instance();

        $student_id = $_POST['student_id'];
        $brief_id = $_POST['brief_id'];
        $input_evaluation_id = $_POST['evaluation_id'];
        $competences = $_POST['competences'];
        $comment = $_POST['comment'] ;
        $review = $_POST['review'];
        $level = $_POST['level'];
        

        $evaluation_id = $evaluation_service->insert_evaluation($student_id, $brief_id, $comment, $review, $level);
        if(is_numeric($evaluation_id)){
            foreach($competences as $competence_id => $level){
                $result = $evaluation_service->link_evaluation_competence($evaluation_id, $competence_id, $level);
                if(!$result){
                    return false;
                }
            }
        }
        if($result){
            header('Location: /teacher/evaluations');
            exit();
        }


    }
}
