<?php

namespace App\Models;

class Teacher extends User {
    private string $role;

    public function __construct($id, $first_name, $last_name, $email,$created_date)
    {
        parent::__construct($id, $first_name, $last_name, $email,$created_date);
        $this->role='teacher';
    }

    public function get_role(){
        return $this->role;
    }

}