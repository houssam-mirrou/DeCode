<?php

namespace App\Mappers;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;

class UserMapper
{
    public static function map_user($user)
    {
        if ($user['role'] == 'admin') {
            return new Admin($user['id'], $user['first_name'], $user['last_name'], $user['email']);
        } else if ($user['role'] == 'teacher') {
            return new Teacher($user['id'], $user['first_name'], $user['last_name'], $user['email']);
        }
        else {
            return new Student($user['id'], $user['first_name'], $user['last_name'], $user['email']);
        }
    }
}
