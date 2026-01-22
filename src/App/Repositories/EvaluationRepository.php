<?php

namespace App\Repositories;

use App\Daos\EvaluationDao;
use App\Dtos\StudentGradeDTO;

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

    public function get_student_evaluations($student_id) {
    $rows = $this->evaluation_dao->get_student_evaluations($student_id);

    // 2. Group by Brief ID
    $evaluations = [];
    
    foreach ($rows as $row) {
        $briefId = $row['brief_id'];

        if (!isset($evaluations[$briefId])) {
            $evaluations[$briefId] = new StudentGradeDTO(
                $row['title'],
                $row['graded_date'],
                $row['status'],
                $row['teacher_comment']
            );
        }

        // Add Skill to the existing Brief object
        if ($row['skill_name']) {
            $evaluations[$briefId]->skills[] = [
                'name' => $row['skill_name'],
                'level' => $row['skill_level']
            ];
        }
    }
        return $evaluations;
    }
}