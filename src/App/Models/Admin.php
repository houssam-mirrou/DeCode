<?php

namespace App\Models;

class Admin extends User {
    private string $role;
    public function __construct($id, $first_name, $last_name, $email,$created_date)
    {
        parent::__construct($id, $first_name, $last_name, $email,$created_date);
        $this->role='admin';
    }
    public function get_role(){
        return $this->role;
    }
}