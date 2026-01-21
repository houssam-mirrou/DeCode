<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Functions;
use App\Daos\SprintDao;
use App\Repositories\SprintRepository;
use App\Services\BriefService;
use App\Services\SprintServices;
use App\Services\CompetenceServices;

class TeacherBriefController extends Controller
{
    public function index()
    {
        $sprint_service = SprintServices::get_instance();
        $competence_service = CompetenceServices::get_instance();
        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences();
        $competences = $competence_service->get_competences();
        $this->view('Pages.Teacher.brief', [
            'sprints' => $sprints,
            'competences' => $competences
        ]);
    }

    public function add_brief()
    {
        $brief_service = BriefService::get_instance();
        $sprint_service = SprintServices::get_instance();
        $competence_service = CompetenceServices::get_instance();
        $sprints = $sprint_service->get_all_sprints();
        $competences = $competence_service->get_competences();

        $title = $_POST['title'];
        $sprint_id = $_POST['sprint_id'];
        $type = $_POST['type'];
        $date_remise = $_POST['date_remise'];
        $description = $_POST['description'];
        $input_competences = $_POST['competences'];
        $result = $brief_service->insert_brief($title, $description, $date_remise, $type, $sprint_id);
        if (is_numeric($result)) {
            $brief_id = $result;
            foreach ($input_competences as $competence_id => $data) {
                if (isset($data['checked'])) {
                    if ($data['checked'] == 'on' && isset($data['level'])) {
                        $level_number = $data['level'];
                        $brief_service->insert_brief_comepetences($brief_id, $competence_id, $level_number);
                    }
                }
            }

            header('Location: /teacher/briefs');
            exit();
        } else {
            $this->view('Pages.Teacher.brief', [
                'sprints' => $sprints,
                'competences' => $competences,
                'errors_levels' => $result
            ]);
        }
    }

    public function delete_brief()
    {
        $brief_service = BriefService::get_instance();
        $sprint_service = SprintServices::get_instance();
        $competence_service = CompetenceServices::get_instance();
        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences();
        $competences = $competence_service->get_competences();

        $id = $_POST['id'];
        $errors = $brief_service->delete_brief($id);
        if ($errors === true) {
            header('Location: /teacher/briefs');
            exit();
        } else {
            $this->view('Pages.Teacher.brief', [
                'sprints' => $sprints,
                'competences' => $competences,
                'errors' => $errors
            ]);
        }
    }

    public function edit_brief()
    {
        $brief_service = BriefService::get_instance();
        $sprint_service = SprintServices::get_instance();
        $competence_service = CompetenceServices::get_instance();
        $sprints = $sprint_service->get_all_sprints_with_briefs_and_competences();
        $competences = $competence_service->get_competences();

        $brief_id = $_POST['id'];
        $title = $_POST['title'];
        $sprint_id = $_POST['sprint_id'];
        $type = $_POST['type'];
        $date_remise = $_POST['date_remise'];
        $description = $_POST['description'];



        $input_competences = $_POST['competences'];
        $errors = $brief_service->update_brief($brief_id, $title, $description, $date_remise, $type, $sprint_id);
        if ($errors === true) {
            $brief_service->delete_brief_competences($brief_id);
            foreach ($input_competences as $competence_id => $data) {
                if (isset($data['checked'])) {
                    if ($data['checked'] == 'on' && isset($data['level'])) {
                        $level_number = $data['level'];
                        $brief_service->insert_brief_comepetences($brief_id, $competence_id, $level_number);
                    }
                }
            }
            header('Location: /teacher/briefs');
            exit();
        } else {
            $this->view('Pages.Teacher.brief', [
                'sprints' => $sprints,
                'competences' => $competences,
                'errors_levels' => $errors
            ]);
        }
    }
}
