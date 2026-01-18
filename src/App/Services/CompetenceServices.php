<?php

namespace App\Services;

use App\Repositories\CompeteceRepository;

class CompetenceServices {
    private $competence_repository;
    private static $instance;
    private function __construct()
    {
        $this->competence_repository = CompeteceRepository::get_instance();
    }
    public static function get_instance(){
        if(self::$instance==null){
            self::$instance=new self();
        }
        return self::$instance;
    }

    public function get_competences(){
        return $this->competence_repository->get_competences();
    }


    public function insert_competence($code,$libelle,$description=''){
        $errors = [];
        if(empty($code)){
            $errors['code']='The Code must not be empty !';
        }
        if(empty($libelle)){
            $errors['libelle']='The Libelle must not be empty !';
        }
        if(!empty($errors)){
            return $errors;
        }
        return $this->competence_repository->insert_competence($code,$libelle,$description);
    }

    public function delete_competence($id){
        return $this->competence_repository->delete_competence($id);
    }

    public function update_competence($id,$code,$libelle,$description){
        return $this->competence_repository->update_competence($id,$code,$libelle,$description);
    }
}