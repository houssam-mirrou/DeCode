<?php

namespace App\Daos;

use App\Core\DataBase;

class BriefDao
{
    private $data;
    private static $instance;
    private function __construct()
    {
        $this->data = DataBase::get_instance();
    }
    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert_brief($title, $description, $date_remise, $type, $sprint_id)
    {
        $query = 'INSERT into brief (title,description,date_remise,type,sprint_id)
                    values (:title,:description,:date_remise,:type,:sprint_id) RETURNING id';
        $params = [
            ':title' => $title,
            ':description' => $description,
            ':date_remise' => $date_remise,
            ':type' => $type,
            ':sprint_id' => $sprint_id
        ];

        $result = $this->data->query($query, $params);
        if ($result && isset($result[0]['id'])) {
            return $result[0]['id'];
        }
        return false;
    }
    public function update_brief($id, $title, $description, $date_remise, $type, $sprint_id)
    {
        $query = 'UPDATE brief set title=:title,description=:description,
                        date_remise=:date_remise,type=:type,sprint_id=:sprint_id
                        where id=:id';
        $params = [
            ':title' => $title,
            ':description' => $description,
            ':date_remise' => $date_remise,
            ':type' => $type,
            ':sprint_id' => $sprint_id,
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function delete_brief($id)
    {
        $query = 'DELETE from brief where id=:id';
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function insert_brief_comepetences($brief_id, $competence_id, $level)
    {
        $query = 'INSERT into brief_competence (brief_id,competence_id,level)
                    values(:brief_id,:competence_id,:level)';
        $params = [
            ':brief_id' => $brief_id,
            ':competence_id' => $competence_id,
            ':level' => $level

        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function get_last_brief_id()
    {
        return $this->data->get_last_inserted_id_query();
    }

    public function get_brief_by_sprint_id($sprint_id) {
        $query = 'SELECT * from brief where sprint_id=:sprint_id';
        $params = [
            'sprint_id'=>$sprint_id
        ];
        $result = $this->data->query($query,$params);
        return $result;
    }

    public function delete_brief_competences($id){
        $query = 'DELETE from brief_competence where brief_id=:id';
        $params = [
            ':id' => $id

        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
}
