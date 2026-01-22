<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $this->view('Pages.Dashboards.admin');
    }
}
