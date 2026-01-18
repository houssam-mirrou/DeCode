<?php

namespace App\Daos;

use App\Core\DataBase;

class CompetenceDao {
    private $data;
    private static $instance;
    private function __construct()
    {
        $this->data = DataBase::get_instance();
    }
    
    public static function get_instance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert_competence($code,$libelle,$description=''){
        $query = 'INSERT into competence (code,libelle,description)
                    values (:code,:libelle,:description)';
        $params = [
            ':code'=>$code,
            ':libelle'=>$libelle,
            ':description'=>$description
        ];
        $result = $this->data->query($query,$params);
        return $result;
    }

    public function delete_competence($id){
        $query = 'DELETE from competence where id=:id';
        $params = [
            ':id'=>$id
        ];
        $result = $this->data->query($query,$params);
        return $result;
    }

    public function update_competence($id,$code,$libelle,$description=''){
        $query = 'UPDATE competence set code=:code , libelle=:libelle , description=:description
                    where id=:id';
        $params = [
            ':code'=>$code,
            ':libelle'=>$libelle,
            ':description'=>$description,
            ':id'=>$id
        ];
        $result= $this->data->query($query,$params);
        return $result;
    }
    public function get_all_competence(){
        $query = 'SELECT * from competence';
        $result = $this->data->query($query);
        return $result;
    }
}