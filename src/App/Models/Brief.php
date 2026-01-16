<?php

namespace App\Models;

class Brief {
    private int $id;
    private int $title;
    private int $description;
    private int $date_remise;
    private int $type;
    public function __construct($id,$title,$description,$date_remise,$type)
    {
        $this->id=$id;
        $this->title=$title;
        $this->description=$description;
        $this->date_remise=$date_remise;
        $this->type=$type;
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
}