<?php

namespace App\Models;


class Student extends User {
    private string $role;
    public function __construct($id, $first_name, $last_name, $email)
    {
        parent::__construct($id, $first_name, $last_name, $email);
        $this->role= 'student';
    }
    public function get_role(){
        return $this->role;
    }
}