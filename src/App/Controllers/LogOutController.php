<?php

namespace App\Controllers;

use App\Core\Session;

class LogOutController {
    public function index(){
        Session::destroy_session();
        header('Location: /');
        exit();
    }
}