<?php

namespace App\Controllers\Student;

use App\Core\Controller;
use App\Models\Evaluation;
use App\Services\EvaluationService;

class StudentEvaluationsController extends Controller {
    public function index() {
        $current_user = $_SESSION['current_user'];
        $evalutaion_service = EvaluationService::get_instance();
        $evaluations = $evalutaion_service->get_student_evaluations($current_user->get_id());
        $this->view('Pages.Student.evaluations',[
            'current_user' => $current_user,
            'evaluations' => $evaluations
        ]);
    }
}