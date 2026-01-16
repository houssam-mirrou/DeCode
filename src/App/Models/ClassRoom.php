<?php

namespace App\Models;

class ClassRoom {
    private int $id;
    private string $name;
    private string $school_year;

    public function __construct($id,$name,$school_year)
    {   
        $this->id=$id;
        $this->name=$name;
        $this->school_year=$school_year;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_name(){
        return $this->name;
    }
    public function get_school_year(){
        return $this->school_year;
    }
}