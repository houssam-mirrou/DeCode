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

    public function get_all_sprints_with_briefs_and_competences()
    {
        $query = 'SELECT 
                s.id AS sprint_id,
                s.name ,
                s.start_date,
                s.end_date,
                s.class_id,

                b.id AS brief_id,
                b.title,
                b.description,
                b.date_remise,
                b.type,

                c.id AS competence_id,
                c.code,
                c.libelle,
                c.description AS competence_description,
                bc.level AS competence_level

            FROM sprint s
            JOIN brief b ON b.sprint_id = s.id
            JOIN brief_competence bc ON bc.brief_id = b.id
            JOIN competence c ON c.id = bc.competence_id
        ';
        $result = $this->data->query($query);
        return $result;
    }

    public function get_all_sprints_with_briefs_and_competences_and_submission($studentId)
    {
        $query = "SELECT 
            s.id AS sprint_id,
            s.name,
            s.start_date,
            s.end_date,
            s.class_id,

            b.id AS brief_id,
            b.title,
            b.description,
            b.date_remise,
            b.type,

            c.id AS competence_id,
            c.code,
            c.libelle,
            c.description AS competence_description,
            bc.level AS competence_level,

            l.id AS livrable_id,
            l.url AS repo_link,
            l.comment AS livrable_comment,
            l.date_submitted,

            e.review AS review_status

        FROM sprint s
        JOIN brief b ON b.sprint_id = s.id
        JOIN brief_competence bc ON bc.brief_id = b.id
        JOIN competence c ON c.id = bc.competence_id

        LEFT JOIN livrable l
            ON l.brief_id = b.id AND l.student_id = 5

        LEFT JOIN evaluation e
            ON e.brief_id = b.id AND e.student_id = 5

        ORDER BY s.start_date DESC, b.date_remise ASC
    ";

        return $this->data->query($query);
    }

    public function get_sprint_by_id($id){
        $query = 'SELECT * from sprint where id=:id';
        $params = [
            ':id'=>$id
        ];
        $result = $this->data->query($query,$params);
        return $result[0];
    }

}
