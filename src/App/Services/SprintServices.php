<?php

namespace App\Services;

use App\Repositories\SprintRepository;

class SprintServices
{
    private $sprint_repository;
    private static $instance;

    private function __construct()
    {
        $this->sprint_repository = SprintRepository::get_instance();
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
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'The name must have carachters';
        }
        if (empty($start_date)) {
            $errors['start_date'] = 'You must provide a date';
        }
        if (empty($end_date)) {
            $errors['end_date'] = 'You must provide a date';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return $this->sprint_repository->insert_sprint($name, $start_date, $end_date, $class_id);
    }

    public function update_sprint($id, $name, $start_date, $end_date, $class_id)
    {
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'The name must have carachters';
        }
        if (empty($start_date)) {
            $errors['start_date'] = 'You must provide a date';
        }
        if (empty($end_date)) {
            $errors['end_date'] = 'You must provide a date';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return $this->sprint_repository->update_sprint($id, $name, $start_date, $end_date, $class_id);
    }

    public function delete_sprint($id)
    {
        return $this->sprint_repository->delete_sprint($id);
    }
    public function get_all_sprints()
    {
        return $this->sprint_repository->get_all_sprints();
    }
    public function get_all_sprints_with_briefs_and_competences()
    {
        return $this->sprint_repository->get_all_sprints_with_briefs_and_competences();
    }
    public function get_all_sprints_with_briefs_and_competences_and_submission($studentId)
    {
        return $this->sprint_repository->get_all_sprints_with_briefs_and_competences_and_submission($studentId);
    }

    public function get_sprint_by_id($id){
        return $this->sprint_repository->get_sprint_by_id($id);
    }

    public function get_all_briefs_submitted_by_students($id){
        return $this->sprint_repository->get_all_briefs_submitted_by_students($id);
    }
}
