<?php

namespace App\Core;

class Session
{
    public static function start_session()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function set_user($user)
    {
        $_SESSION['current_user'] = $user;
    }
    public static function destroy_session()
    {
        $_SESSION=[];
        unset($_SESSION);
        session_destroy();
    }
}
