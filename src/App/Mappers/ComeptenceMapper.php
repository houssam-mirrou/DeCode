<?php

namespace App\Mappers;
use App\Models\Competence;

class ComeptenceMapper {
    public static function map_competence($id,$code,$libelle,$description){
        $competence = new Competence($id,$code,$description,$libelle);
        return $competence;
    } 
    public static function map_competence_info($id,$code,$libelle,$description,$competence_lvl){
        $competence = new Competence($id,$code,$description,$libelle,$competence_lvl);
        return $competence;
    }
}