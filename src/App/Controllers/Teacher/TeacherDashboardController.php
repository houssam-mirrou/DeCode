<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $this->view('Pages.Dashboards.teacher');
    }
}
