<?php
require '../config.php';
require '../vendor/autoload.php';

use App\Routing\Router;

session_start();

$router = new Router;

$router->get('/', 'ProductController', 'index');
$router->post('/comments', 'CommentController', 'create');
$router->patch('/comments', 'CommentController', 'approve');

$router->get('/users', 'UserController', 'index');
$router->get('/login', 'UserController', 'loginPage');
$router->post('/users', 'UserController', 'login');


$url = rtrim($_SERVER['REQUEST_URI'], '/');
$method = isset($_POST['_method']) ? $_POST['_method'] : $_SERVER['REQUEST_METHOD'];

$router->run($method, $url);

$_SESSION['prev_url'] = rtrim(PUBLIC_PATH, '/') . $url;
unset($_SESSION['errors']);
unset($_SESSION['success']);


