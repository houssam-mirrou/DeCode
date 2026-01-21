<?php

namespace App\Models;

class Competence {
    private int $id;
    private string $code;
    private string $description;
    private string $libelle;
    private string $competence_lvl;
    public function __construct($id,$code,$description,$libelle,$competence_lvl ='')
    {
        $this->id=$id;
        $this->code=$code;
        $this->description=$description;
        $this->libelle=$libelle;
        $this->competence_lvl = $competence_lvl;
    }

    public function get_id(){
        return $this->id;
    }
    public function get_code(){
        return $this->code;
    }
    public function get_description(){
        return $this->description;
    }
    public function get_libelle(){
        return $this->libelle;
    }
    public function get_level(){
        return $this->competence_lvl;
    }
}