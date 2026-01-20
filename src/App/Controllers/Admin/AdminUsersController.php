<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Functions;
use App\Services\UserServices;
use App\Services\ClassesServices;

class AdminUsersController extends Controller
{
    public function index()
    {
        $user_service = UserServices::get_instance();
        $users = $user_service->get_users_without_current($_SESSION['current_user']->get_id());
        $classes_service = ClassesServices::get_instance();
        $classes = $classes_service->get_all_classes();
        $this->view('Pages.Admin.users', [
            'users' => $users,
            'classes' => $classes
        ]);
    }

    public function add_user()
    {
        $user_service = UserServices::get_instance();
        $classes_service = ClassesServices::get_instance();

        $users = $user_service->get_users_without_current($_SESSION['current_user']->get_id());
        $classes_service = ClassesServices::get_instance();
        $classes = $classes_service->get_all_classes();

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $class_id = $_POST['class_id'];
        switch ($role) {
            case 'admin':
                $errors = $user_service->insert_admin($first_name, $last_name, $email, $password, $role);
                if ($errors === true) {
                    header('Location: /admin/users');
                    exit();
                } else {
                    $this->view('Pages.Admin.users', [
                        'users' => $users,
                        'classes' => $classes,
                        'errors' => $errors
                    ]);
                }
                break;
            case 'teacher':
                $errors = $user_service->insert_admin($first_name, $last_name, $email, $password, $role);
                if ($errors === true) {
                    header('Location: /admin/users');
                    exit();
                } else {
                    $this->view('Pages.Admin.users', [
                        'users' => $users,
                        'classes' => $classes,
                        'errors' => $errors
                    ]);
                }
                break;
            default:
                if ($class_id === '') {
                    $errors['class'] = 'You must put the class';
                    $this->view('Pages.Admin.users', [
                        'users' => $users,
                        'classes' => $classes,
                        'errors' => $errors
                    ]);
                } else {
                    $errors = $user_service->insert_student($first_name, $last_name, $email, $password, $role, $class_id);
                    if ($errors === true) {
                        header('Location: /admin/users');
                        exit();
                    } else {
                        $this->view('Pages.Admin.users', [
                            'users' => $users,
                            'classes' => $classes,
                            'errors' => $errors
                        ]);
                    }
                }
                break;
        }
    }

    public function update_user()
    {
        $user_service = UserServices::get_instance();
        $classes_service = ClassesServices::get_instance();

        $users = $user_service->get_users_without_current($_SESSION['current_user']->get_id());
        $classes_service = ClassesServices::get_instance();
        $classes = $classes_service->get_all_classes();

        $user_id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $class_id = $_POST['class_id'];
        switch ($role) {
            case 'admin':
                $errors = $user_service->update_user_with_password($user_id, $first_name, $last_name, $email, $password, $role, $class_id);
                if ($errors === true) {
                    header('Location: /admin/users');
                    exit();
                } else {
                    $this->view('Pages.Admin.users', [
                        'users' => $users,
                        'classes' => $classes,
                        'errors' => $errors
                    ]);
                }
                break;
            case 'teacher':
                $errors = $user_service->update_user_with_password($user_id, $first_name, $last_name, $email, $password, $role, $class_id);
                if ($errors === true) {
                    header('Location: /admin/users');
                    exit();
                } else {
                    $this->view('Pages.Admin.users', [
                        'users' => $users,
                        'classes' => $classes,
                        'errors' => $errors
                    ]);
                }
                break;
            default:
                if ($class_id === '') {
                    $errors['class'] = 'You must put the class';
                    $this->view('Pages.Admin.users', [
                        'users' => $users,
                        'classes' => $classes,
                        'errors' => $errors
                    ]);
                } else {
                    $errors = $user_service->update_user_with_password($user_id, $first_name, $last_name, $email, $password, $role, $class_id);
                    if ($errors === true) {
                        header('Location: /admin/users');
                        exit();
                    } else {
                        $this->view('Pages.Admin.users', [
                            'users' => $users,
                            'classes' => $classes,
                            'errors' => $errors
                        ]);
                    }
                }
                break;
        }
    }

    public function delete_user()
    {
        $user_service = UserServices::get_instance();
        $classes_service = ClassesServices::get_instance();

        $users = $user_service->get_users_without_current($_SESSION['current_user']->get_id());
        $classes_service = ClassesServices::get_instance();
        $classes = $classes_service->get_all_classes();

        $id = $_POST['id'];
        $errors = $user_service->delete_user_by_id($id);
        if ($errors === true) {
            header('Location: /admin/users');
            exit();
        } else {
            $this->view('Pages.Admin.users', [
                'users' => $users,
                'classes' => $classes,
                'errors' => $errors
            ]);
        }
    }
}
