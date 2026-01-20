<?php

namespace App\Daos;

use App\Core\DataBase;

class SprintDao
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
    public function insert_sprint($name, $start_date, $end_date, $class_id)
    {
        $query = 'INSERT into sprint (name,start_date,end_date,class_id)
                    values (:name,:start_date,:end_date,:class_id)';
        $params = [
            ':name' => $name,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':class_id' => $class_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function update_sprint($id, $name, $start_date, $end_date, $class_id)
    {
        $query = 'UPDATE sprint set name=:name,start_date=:start_date,end_date=:end_date ,class_id=:class_id where id=:id';
        $params = [
            ':name' => $name,
            ':start_date' => $start_date,
            ':end_date' => $end_date,
            ':id' => $id,
            ':class_id' => $class_id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }
    public function delete_sprint($id)
    {
        $query = 'DELETE from sprint where id=:id';
        $params = [
            ':id' => $id
        ];
        $result = $this->data->query($query, $params);
        return $result;
    }

    public function get_all_sprints()
    {
        $query = 'SELECT * from sprint ;';
        $result = $this->data->query($query);
        return $result;
    }
}
