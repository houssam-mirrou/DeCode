<?php

namespace App\Mappers;
use App\Models\Competence;

class ComeptenceMapper {
    public static function map_competence($id,$code,$libelle,$description){
        $competence = new Competence($id,$code,$description,$libelle);
        return $competence;
    } 
}