<?php

namespace App\Repositories;

use App\Daos\BriefDao;

class BriefRepository {
    private $brief_dao;
    private static $instance;
    private function __construct()
    {
        $this->brief_dao = BriefDao::get_instance();
    }
    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert_brief($title,$description,$date_remise,$type,$sprint_id){
        return $this->brief_dao->insert_brief($title,$description,$date_remise,$type,$sprint_id);
    }

    public function insert_brief_comepetences ($brief_id,$competence_id,$level){
        switch ($level) {
            case '1':
                $level = 'IMITER';
                break;
            case '2':
                $level = 'S_ADAPTER';
                break;
            
            default:
                $level = 'TRANSPOSER';
                break;
        }
        return $this->brief_dao->insert_brief_comepetences ($brief_id,$competence_id,$level);
    }

    public function get_last_brief_id(){
        return $this->brief_dao->get_last_brief_id();
    }

    public function delete_brief($id){
        return $this->brief_dao->delete_brief($id);
    }

    public function update_brief($id, $title, $description, $date_remise, $type, $sprint_id){
        return $this->brief_dao->update_brief($id, $title, $description, $date_remise, $type, $sprint_id);
    }

    public function delete_brief_competences($id){
        return $this->brief_dao->delete_brief_competences($id);
    }
}