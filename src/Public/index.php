<?php

use App\Core\Functions;
use App\Core\Router;
use App\Core\Session;
use App\Daos\UserDao;

require __DIR__ . '/../vendor/autoload.php';

Session::start_session();

$user = UserDao::get_instance();

// $password = password_hash('sara123654',PASSWORD_DEFAULT);

// $user->insert_user('Sara','El Amrani','sara.elamrani@gmail.com',$password,'admin');
//hossam.mirrou@gmail.com
//omar.zerouali@gmail.com

$router = new Router();

//home page
$router->get('/', 'HomeController@index');
$router->post('/logout','LogOutController@index');
$router->post('/login','LogInController@log_in');

//admin
$router->get('/admin/dashboard','AdminDashboardController@index');

//admin-competence
$router->get('/admin/competences','AdminCompetencesController@index');
$router->post('/admin/competence/create','AdminCompetencesController@add_competence');
$router->post('/admin/competence/delete','AdminCompetencesController@delete_competence');
$router->post('/admin/competence/update','AdminCompetencesController@update_competence');


//admin-classes
$router->get('/admin/classes','AdminClassesController@index');
$router->post('/admin/class/create','AdminClassesController@add_class');
$router->post('/admin/class/delete','AdminClassesController@delete_class');
$router->post('/admin/class/update','AdminClassesController@update_class');
$router->post('/admin/class/assign-teachers','AdminClassesController@assign_teacher');
$router->post('/admin/class/remove-teacher','AdminClassesController@remove_teacher');

//admin-users
$router->get('/admin/users','AdminUsersController@index');
$router->post('/admin/user/create','AdminUsersController@add_user');
$router->post('/admin/user/update','AdminUsersController@update_user');
$router->post('/admin/user/delete','AdminUsersController@delete_user');

//admin-sprints
$router->get('/admin/sprints','AdminSprintsController@index');
$router->post('/admin/sprint/create','AdminSprintsController@insert_sprint');
$router->post('/admin/sprint/delete','AdminSprintsController@delete_sprint');
$router->post('/admin/sprint/update','AdminSprintsController@update_sprint');

//teacher
$router->get('/teacher/dashboard','TeacherDashboardController@index');

//teacher-brief
$router->get('/teacher/briefs','TeacherBriefController@index');
$router->post('/teacher/brief/create','TeacherBriefController@add_brief');
$router->post('/teacher/brief/delete','TeacherBriefController@delete_brief');
$router->post('/teacher/brief/update','TeacherBriefController@edit_brief');

//student
$router->get('/student/dashboard','StudentDashController@index');
//student-submit brief
$router->post('/student/brief/submit','StudentDashController@submit');

//student-projects
$router->get('/student/briefs','StudentProjectController@index');
//student-brief-page
$router->get('/student/brief/{id}','StudentBriefController@index');
$router->get('/teacher/evaluations','TeacherEvaluationController@index');



$router->dispatch();
