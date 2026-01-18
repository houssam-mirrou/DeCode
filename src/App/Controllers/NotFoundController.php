<?php

namespace App\Controllers;

use App\Core\Controller;

class NotFoundController extends Controller{
    public function index(){
        http_response_code(404);
        $this->view('Pages.404');
    }
}