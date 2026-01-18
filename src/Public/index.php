<?php

use App\Core\Functions;
use App\Core\Router;
use App\Core\Session;
use App\Daos\UserDao;

require __DIR__ . '/../vendor/autoload.php';

Session::start_session();

$user = UserDao::get_instance();

// $password = password_hash('sara123654',PASSWORD_DEFAULT);

// $user->insert_admin('Sara','El Amrani','sara.elamrani@gmail.com',$password,'admin');
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
$router->get('/admin/competences','AdminCompetencesController@index');
$router->post('/admin/competence/create','AdminCompetencesController@add_competence');
$router->post('/admin/competence/delete','AdminCompetencesController@delete_competence');
$router->post('/admin/competence/update','AdminCompetencesController@update_competence');



$router->dispatch();
