<?php

namespace App\Repositories;

use App\Daos\EvaluationDao;

class EvaluationRepository{
    private static $instance;
    private $evaluation_dao;
    private function __construct()
    {
        $this->evaluation_dao = EvaluationDao::get_instance();
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
        return $this->evaluation_dao->insert_evaluation($student_id, $brief_id, $comment, $review, $level);
    }  
    public function update_evaluation($evaluation_id, $comment, $review, $level)
    {
        return $this->evaluation_dao->update_evaluation($evaluation_id, $comment, $review, $level);
    }

    public function link_evaluation_competence($evaluation_id, $competence_id,$level)
    {
        return $this->evaluation_dao->link_evaluation_competence($evaluation_id, $competence_id,$level);
    }
}