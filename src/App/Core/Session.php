<?php

namespace App\Core;

class Session
{
    public function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function set_user($user)
    {
        $_SESSION['current_user'] = $user;
    }
    public function destroy_session()
    {
        $_SESSION=[];
        unset($_SESSION);
        session_destroy();
    }
}
