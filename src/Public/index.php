<?php

use App\Core\Functions;
use App\Core\Router;
use App\Core\Session;
use App\Daos\UserDao;

require __DIR__ . '/../vendor/autoload.php';

Session::start_session();

// $user = UserDao::get_instance();

// // $password = password_hash('omar123654',PASSWORD_DEFAULT);

// // $user->insert_admin('Omar','Zerouali','omar.zerouali@gmail.com',$password,'teacher');

// // //omar.zerouali@gmail.com

$router = new Router();

if(isset($_SESSION['current_user'])) {
    $router->get('/', 'DashboardController@index');
} else {
    $router->get('/', 'LogInController@index');
}
$router->post('/logout','LogOutController@index');

$router->post('/login','LogInController@log_in');

$router->dispatch();
