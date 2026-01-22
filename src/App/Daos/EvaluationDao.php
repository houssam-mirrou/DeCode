<?php

namespace App\Daos;

use App\Core\DataBase;

class EvaluationDao
{
    private static $instance;
    private $data;
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

    public function insert_evaluation($student_id, $brief_id, $comment, $review, $level)
    {
        $query = "INSERT INTO evaluation (student_id, brief_id, comment, review, level) 
                VALUES (:student_id, :brief_id, :comment, :review, :level) RETURNING id";
        $params = [
            ':student_id' => $student_id,
            ':brief_id' => $brief_id,
            ':comment' => $comment,
            ':review' => $review,
            ':level' => $level
        ];
        $result = $this->data->query($query, $params);
        return $result && isset($result[0]['id']) ? $result[0]['id'] : false;
    }

    public function update_evaluation($evaluation_id, $comment, $review, $level)
    {
        $query = "UPDATE evaluation 
                  SET comment = :comment, review = :review, level = :level 
                  WHERE id = :evaluation_id";
        $params = [
            ':comment' => $comment,
            ':review' => $review,
            ':level' => $level,
            ':evaluation_id' => $evaluation_id
        ];
        return $this->data->query($query, $params);
    }

    public function link_evaluation_competence($evaluation_id, $competence_id,$level)
    {
        $query = "INSERT INTO evaluation_competences (evaluation_id, competence_id,level) 
                  VALUES (:evaluation_id, :competence_id,:level)";
        $params = [
            ':evaluation_id' => $evaluation_id,
            ':competence_id' => $competence_id,
            ':level' => $level
        ];
        return $this->data->query($query, $params);
    }
}