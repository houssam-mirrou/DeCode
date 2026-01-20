<?php

namespace App\Repositories;

use App\Daos\SprintDao;
use App\Mappers\SprintMapper;

class SprintRepository
{
    private $sprint_dao;
    private static $instance;
    private function __construct()
    {
        $this->sprint_dao = SprintDao::get_instance();
    }

    public static function get_instance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert_sprint($name, $start_date, $end_date, $class_id)
    {
        return $this->sprint_dao->insert_sprint($name, $start_date, $end_date, $class_id);
    }

    public function update_sprint($id, $name, $start_date, $end_date, $class_id)
    {
        return $this->sprint_dao->update_sprint($id, $name, $start_date, $end_date, $class_id);
    }

    public function delete_sprint($id)
    {
        return $this->sprint_dao->delete_sprint($id);
    }

    public function get_all_sprints(){
        $db_sprints = $this->sprint_dao->get_all_sprints();
        $sprints = [];
        foreach($db_sprints as $sprint){
            array_push($sprints,SprintMapper::map_sprint($sprint));
        }
        return $sprints;
    }
}
