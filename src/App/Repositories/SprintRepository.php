<?php

namespace App\Repositories;

use App\Controllers\Teacher\TeacherEvaluationBriefController;
use App\Core\Functions;
use App\Daos\BriefDao;
use App\Daos\CompetenceDao;
use App\Daos\SprintDao;
use App\Daos\UserDao;
use App\Dtos\BriefEvaluationDTO;
use App\Dtos\SprintEvaluationDTO as DtosSprintEvaluationDTO;
use App\Dtos\StudentEvaluationDTO;
use App\Dtos\StudentEvaluationTeacherDTO;
use App\Mappers\BriefMapper;
use App\Mappers\ComeptenceMapper;
use App\Mappers\LivrableMapper;
use App\Mappers\SprintMapper;
use App\Mappers\UserMapper;
use App\Models\Livrable;
use WeakMap;

class SprintRepository
{
    private $sprint_dao;
    private $brief_dao;
    private $competence_dao;
    private static $instance;
    private function __construct()
    {
        $this->brief_dao = BriefDao::get_instance();
        $this->sprint_dao = SprintDao::get_instance();
        $this->competence_dao = CompetenceDao::get_instance();
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

    public function get_all_sprints()
    {
        $db_sprints = $this->sprint_dao->get_all_sprints();
        $sprints = [];
        foreach ($db_sprints as $sprint) {
            array_push($sprints, SprintMapper::map_sprint($sprint));
        }
        return $sprints;
    }

    public function get_all_sprints_with_briefs_and_competences()
    {
        $rows = $this->sprint_dao->get_all_sprints_with_briefs_and_competences();

        $result = [];

        foreach ($rows as $row) {

            $sprintId = $row['sprint_id'];

            if (!isset($result[$sprintId])) {
                $result[$sprintId] = [
                    'sprint' => SprintMapper::map_sprint_info(
                        $row['sprint_id'],
                        $row['name'],
                        $row['start_date'],
                        $row['end_date'],
                        $row['class_id']
                    ),
                    'briefs' => []
                ];
            }

            $briefId = $row['brief_id'];

            if (!isset($result[$sprintId]['briefs'][$briefId])) {
                $result[$sprintId]['briefs'][$briefId] = [
                    'brief' => BriefMapper::map_brief_info(
                        $row['brief_id'],
                        $row['title'],
                        $row['description'],
                        $row['date_remise'],
                        $row['type'],
                        $row['sprint_id']
                    ),
                    'competences' => []
                ];
            }

            $result[$sprintId]['briefs'][$briefId]['competences'][] =
                ComeptenceMapper::map_competence_info(
                    $row['competence_id'],
                    $row['code'],
                    $row['libelle'],
                    $row['competence_description'],
                    $row['competence_level']
                );
        }

        return $result;
    }

    public function get_all_sprints_with_briefs_and_competences_and_submission($studentId)
    {
        $rows = $this->sprint_dao->get_all_sprints_with_briefs_and_competences_and_submission($studentId);

        $result = [];

        foreach ($rows as $row) {

            $sprintId = $row['sprint_id'];

            if (!isset($result[$sprintId])) {
                $result[$sprintId] = [
                    'sprint' => SprintMapper::map_sprint_info(
                        $row['sprint_id'],
                        $row['name'],
                        $row['start_date'],
                        $row['end_date'],
                        $row['class_id']
                    ),
                    'briefs' => []
                ];
            }

            $briefId = $row['brief_id'];

            if (!isset($result[$sprintId]['briefs'][$briefId])) {

                $brief = BriefMapper::map_brief_info(
                    $row['brief_id'],
                    $row['title'],
                    $row['description'],
                    $row['date_remise'],
                    $row['type'],
                    $row['sprint_id']
                );

                if (!empty($row['repo_link'])) {
                    $string = 'ana hna';
                    // Functions::dd($string);
                    $livrable = new Livrable(
                        $row['livrable_id'] ?? 0,
                        $row['repo_link'],
                        $row['livrable_comment'] ?? '',
                        $row['date_submitted'] ?? date('Y-m-d H:i:s')
                    );

                    $brief->set_livrable(clone $livrable);
                }

                if (!empty($row['review_status'])) {
                    $brief->set_review_status($row['review_status']);
                }

                $result[$sprintId]['briefs'][$briefId] = [
                    'brief' => $brief,
                    'competences' => []
                ];
            }

            $result[$sprintId]['briefs'][$briefId]['competences'][] =
                ComeptenceMapper::map_competence_info(
                    $row['competence_id'],
                    $row['code'],
                    $row['libelle'],
                    $row['competence_description'],
                    $row['competence_level']
                );
        }

        return $result;
    }

    public function get_sprint_by_id($id)
    {
        $result = $this->sprint_dao->get_sprint_by_id($id);
        $sprint = SprintMapper::map_sprint($result);
        return $sprint;
    }

    public function get_all_briefs_submitted_by_students($class_id)
    {
        $rows = $this->sprint_dao->get_all_briefs_submitted_by_students($class_id);

        $result = [];

        foreach ($rows as $row) {
            $sprintId = $row['sprint_id'];
            $briefId  = $row['brief_id'];
            $studentId = $row['user_id'];

            // Sprint
            if (!isset($result[$sprintId])) {
                $sprint = SprintMapper::map_sprint_info(
                    $row['sprint_id'],
                    $row['sprint_name'],
                    $row['start_date'],
                    $row['end_date'],
                    $row['class_id']
                );
                $result[$sprintId] = new DtosSprintEvaluationDTO($sprint);
            }

            // Brief
            if (!isset($result[$sprintId]->briefs[$briefId])) {
                $brief = BriefMapper::map_brief_info(
                    $row['brief_id'],
                    $row['title'],
                    $row['description'],
                    $row['date_remise'],
                    $row['type'],
                    $row['sprint_id']
                );
                $result[$sprintId]->briefs[$briefId] = new BriefEvaluationDTO($brief);
            }

            // Student
            $student = UserMapper::map_user([
                'id' => $row['user_id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'role' => $row['role'],
                'created_date' => $row['created_date'],
                'class_id' => $class_id
            ]);

            if (!isset($result[$sprintId]->briefs[$briefId]->students[$studentId])) {
                $result[$sprintId]->briefs[$briefId]->students[$studentId]
                    = new StudentEvaluationDTO($student);
            }

            // Livrable
            if (!empty($row['repo_link'])) {
                $result[$sprintId]->briefs[$briefId]->students[$studentId]->livrable
                    = LivrableMapper::map_livrable_info(
                        $row['livrable_id'],
                        $row['repo_link'],
                        $row['livrable_comment'],
                        $row['date_submitted']
                    );
            }
            //Functions::dd($result);
            // Review
            $result[$sprintId]->briefs[$briefId]->students[$studentId]->review_status
                = $row['review_status'];
        }

        return $result;
    }

    public function get_student_evaluation_data($brief_id, $student_id){
        $result = $this->sprint_dao->get_student_evaluation_data($brief_id, $student_id);
        $dto = StudentEvaluationTeacherDTO::fromDatabase($result['context'],$result['competences']);
        return $dto;
    }
}
