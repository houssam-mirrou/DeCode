<?php

namespace App\Services;

use App\Repositories\BriefRepository;

class BriefService {
    private $brief_repository;
    private static $instance;
    private function __construct()
    {
        $this->brief_repository = BriefRepository::get_instance();
    }
    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert_brief($title,$description,$date_remise,$type,$sprint_id){
        $errors = [];
        if(empty($title)){
            $errors['title']='Title is empty';
        }
        if(empty($description)){
            $errors['description']='Description is empty';
        }
        if(empty($date_remise)){
            $errors['date_remise']='Date is empty';
        }
        if(empty($type)){
            $errors['type']='Type is empty';
        }
        if(empty($sprint_id)){
            $errors['sprint_id']='Sprint id is empty';
        }
        if(!empty($errors)){
            return $errors;
        }
        return $this->brief_repository->insert_brief($title,$description,$date_remise,$type,$sprint_id);
    }

    public function insert_brief_comepetences ($brief_id,$competence_id,$level){
        return $this->brief_repository->insert_brief_comepetences ($brief_id,$competence_id,$level);
    }

    public function delete_brief($id){
        return $this->brief_repository->delete_brief($id);
    }

    public function update_brief($id, $title, $description, $date_remise, $type, $sprint_id){
        return $this->brief_repository->update_brief($id, $title, $description, $date_remise, $type, $sprint_id);
    }

    public function delete_brief_competences($id){
        return $this->brief_repository->delete_brief_competences($id);
    }

    public function get_brief_by_id($id){
        return $this->brief_repository->get_brief_by_id($id);
    }
}