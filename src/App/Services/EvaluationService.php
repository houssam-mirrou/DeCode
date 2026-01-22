<?php

namespace App\Services;

use App\Repositories\EvaluationRepository;

class EvaluationService
{
    private static $instance;
    private $evaluation_repository;
    private function __construct()
    {
        $this->evaluation_repository = EvaluationRepository::get_instance();
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
        return $this->evaluation_repository->insert_evaluation($student_id, $brief_id, $comment, $review, $level);
    }
    public function update_evaluation($evaluation_id, $comment, $review, $level)
    {
        return $this->evaluation_repository->update_evaluation($evaluation_id, $comment, $review, $level);
    }
    public function link_evaluation_competence($evaluation_id, $competence_id,$level)
    {
        return $this->evaluation_repository->link_evaluation_competence($evaluation_id, $competence_id,$level);
    }
}
