<?php

namespace App\Repositories;

use App\Daos\CompetenceDao;
use App\Mappers\ComeptenceMapper;
use App\Models\Competence;

class CompeteceRepository {
    private $competence_dao;
    private static $instance;
    private function __construct()
    {
        $this->competence_dao = CompetenceDao::get_instance();
    }
    public static function get_instance(){
        if(self::$instance==null){
            self::$instance=new self();
        }
        return self::$instance;
    } 

    public function get_competences(){
        $competences_db = $this->competence_dao->get_all_competence();
        $comp_arr=[];
        foreach($competences_db as $comp){
            $competence = ComeptenceMapper::map_competence($comp['id'],$comp['code'],$comp['description'],$comp['libelle']);
            array_push($comp_arr,$competence);
        }
        return $comp_arr;
    }
    public function insert_competence($code,$libelle,$description=''){
        return $this->competence_dao->insert_competence($code,$libelle,$description);
    }
    public function delete_competence($id){
        return $this->competence_dao->delete_competence($id);
    }

    public function update_competence($id,$code,$libelle,$description){
        return $this->competence_dao->update_competence($id,$code,$libelle,$description);
    }
}