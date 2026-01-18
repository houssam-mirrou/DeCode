<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Mappers\ComeptenceMapper;
use App\Services\CompetenceServices;

class AdminCompetencesController extends Controller
{
    public function index()
    {
        $competence_services = CompetenceServices::get_instance();
        $competences = $competence_services->get_competences();

        $this->view('Pages.Admin.competences', [
            'competences' => $competences
        ]);
    }

    public function add_competence()
    {
        $competence_services = CompetenceServices::get_instance();
        $competences = $competence_services->get_competences();

        $code = $_POST['code'];
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $errors = $competence_services->insert_competence($code, $libelle, $description);
        if ($errors === true) {
            header('Location: /admin/competences');
            exit();
        } else {
            $this->view('Pages.Admin.competences', [
                'competences' => $competences,
                'errors' => $errors
            ]);
        }
    }

    public function delete_competence()
    {
        $competence_services = CompetenceServices::get_instance();
        $id = $_POST['id'];
        $competences = $competence_services->get_competences();
        $errors = $competence_services->delete_competence($id);
        if ($errors === true) {
            header('Location: /admin/competences');
            exit();
        } else {
            $this->view('Pages.Admin.competences', [
                'competences' => $competences,
                'errors' => $errors
            ]);
        }
    }

    public function update_competence(){
        $competence_services = CompetenceServices::get_instance();
        $competences = $competence_services->get_competences();
        $id= $_POST['id'];
        $code= $_POST['code'];
        $libelle= $_POST['libelle'];
        $description= $_POST['description'];
        $errors = $competence_services->update_competence($id,$code,$libelle,$description);
        if ($errors === true) {
            header('Location: /admin/competences');
            exit();
        } else {
            $this->view('Pages.Admin.competences', [
                'competences' => $competences,
                'errors' => $errors
            ]);
        }
    }
}
