<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if (isset($_SESSION['current_user'])) {
            if ($_SESSION['current_user']->get_role() == 'admin') {
                header('Location: /admin/dashboard');
                exit();
            } else if ($_SESSION['current_user']->get_role() == 'teacher') {
                header('Location: /teacher/dashboard');
                exit();
            } else {
                header('Location: /student/dashboard');
                exit();
            }
        } else {
            $this->view('Pages.LogIn');
        }
    }
}
