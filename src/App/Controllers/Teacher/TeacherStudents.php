<?php

namespace App\Controllers\Teacher;

class TeacherStudents extends TeacherEvaluationController {
    public function index() {
        $this->view('Pages.Teacher.students');
    }
}