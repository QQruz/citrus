<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\Comment;

class UserController extends Controller {
    
    public function loginPage() {
        if (isset($_SESSION['user'])) {
            redirect(PUBLIC_PATH . 'users');
        }
        $this->view('login');
    }

    public function login() {
        $this->validate();

        if (isset($_SESSION['errors'])) {
            back();
        }

        $user = new User;
        $user = $user->findByName($_POST['name']);

        if ($user && password_verify($_POST['password'], $user->password)) {
            $_SESSION['user'] = $user->id;
            redirect(PUBLIC_PATH . 'users');
        }

        $_SESSION['errors'][] = 'invalid';

        back();
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            redirect(PUBLIC_PATH . 'login');
        }
        $comments = (new Comment)->notApproved();

        $this->view('user', $comments);
    }

    public function validate() {
        if (!isset($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30) {
            $_SESSION['errors'][] = 'name';
        }

        if (!isset($_POST['password']) || strlen($_POST['password']) > 60) {
            $_SESSION['errors'][] = 'password';
        }
    }

}