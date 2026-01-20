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
            return new Admin($user['id'], $user['first_name'], $user['last_name'], $user['email'],$user['created_date']);
        } else if ($user['role'] == 'teacher') {
            return new Teacher($user['id'], $user['first_name'], $user['last_name'], $user['email'],$user['created_date']);
        }
        else {
            return new Student($user['id'], $user['first_name'], $user['last_name'], $user['email'],$user['created_date'],$user['class_id']);
        }
    }
    public static function map_teacher($teacher){
        $teacher = new Teacher($teacher['id'],$teacher['first_name'],$teacher['last_name'],$teacher['email'],$teacher['created_date']);
        return $teacher;
    }
}
