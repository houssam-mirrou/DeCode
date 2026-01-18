<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class AdminClassesController extends Controller {
    public function index() {
        $this->view('Pages.Admin.classes');
    }
}