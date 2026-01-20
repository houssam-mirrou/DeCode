<?php

namespace App\Models;


class Student extends User {
    private string $role;
    private int $class_id;
    public function __construct($id, $first_name, $last_name, $email,$created_date,$class_id = null)
    {
        parent::__construct($id, $first_name, $last_name, $email,$created_date);
        $this->class_id=$class_id;
        $this->role= 'student';
    }
    public function get_role(){
        return $this->role;
    }
    public function get_class_id(){
        return $this->class_id;
    }
}