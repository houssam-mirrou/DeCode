<?php

namespace App\Controllers\Student;

use App\Core\Controller;

class StudentProjectController extends Controller {
    public function index () {
        $this->view('Pages.Student.project');
    }
}