<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if ($_SESSION['current_user']->get_role() == 'admin') {
            $this->view('Pages.Dashboards.admin');
        }
        else if ($_SESSION['current_user']->get_role() == 'teacher'){
            $this->view('Pages.Dashboards.teacher');
        }
        else {
            $this->view('Pages.Dashboards.student');
        }
    }
}
