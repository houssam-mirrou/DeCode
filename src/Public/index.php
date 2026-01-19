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

if(isset($_SESSION['current_user'])) {
    $router->get('/', 'DashboardController@index');
} else {
    $router->get('/', 'LogInController@index');
}
$router->post('/logout','LogOutController@index');

$router->post('/login','LogInController@log_in');

//admin
//admin-competence
$router->get('/admin/competences','AdminCompetencesController@index');
$router->post('/admin/competence/create','AdminCompetencesController@add_competence');
$router->post('/admin/competence/delete','AdminCompetencesController@delete_competence');
$router->post('/admin/competence/update','AdminCompetencesController@update_competence');

//admin-users
$router->get('/admin/users','AdminUsersController@index');

//admin-classes
$router->get('/admin/classes','AdminClassesController@index');
$router->post('/admin/class/create','AdminClassesController@add_class');
$router->post('/admin/class/delete','AdminClassesController@delete_class');
$router->post('/admin/class/update','AdminClassesController@update_class');
$router->post('/admin/class/assign-teachers','AdminClassesController@assign_teacher');
$router->post('/admin/class/remove-teacher','AdminClassesController@remove_teacher');
$router->dispatch();
