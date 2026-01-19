<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class AdminUsersController extends Controller {
    public function index() {
        $this->view('Pages.Admin.users');
    }

    
}