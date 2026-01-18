<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Functions;
use App\Core\Session;
use App\Services\UserServices;

class LogInController extends Controller{
    public function index(){
        $this->view('Pages.LogIn');
    }
    public function log_in(){
        $user_service = UserServices::get_instance();

        $email = $_POST['email'];
        $password = $_POST['password'];
        $auth_controller = AuthController::get_instance();
        $errors = $auth_controller->sign_in($email,$password);
        if($errors === true){
            $user = $user_service->get_user($email);
            Session::set_user($user);
            header('Location: /');
            exit();
        }
        else {
            $this->view('Pages.LogIn',[
                'errors'=>$errors
            ]);
        }
    }
}