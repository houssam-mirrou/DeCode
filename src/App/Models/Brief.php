<?php

namespace App\Models;

class Brief {
    private int $id;
    private string $title;
    private string $description;
    private string $date_remise;
    private string $type;
    private int $sprint_id;
    public function __construct($id,$title,$description,$date_remise,$type,$sprint_id)
    {
        $this->id=$id;
        $this->title=$title;
        $this->description=$description;
        $this->date_remise=$date_remise;
        $this->type=$type;
        $this->sprint_id = $sprint_id;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_title(){
        return $this->title;
    }
    public function get_description(){
        return $this->description;
    }
    public function get_date_remise(){
        return $this->date_remise;
    }
    public function get_type(){
        return $this->type;
    }
    public function get_class_id(){
        return $this->sprint_id;
    }
}