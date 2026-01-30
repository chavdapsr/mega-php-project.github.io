<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
use App\Core\Router;
use App\Core\Auth;

// Start session
Session::start();

// Create router
$router = new Router();

// Home routes
$router->get('/', 'HomeController', 'index');

// Auth routes
$router->get('/login', 'AuthController', 'showLogin');
$router->post('/login', 'AuthController', 'login');
$router->get('/register', 'AuthController', 'showRegister');
$router->post('/register', 'AuthController', 'register');
$router->post('/logout', 'AuthController', 'logout');

// Post routes
$router->get('/posts', 'PostController', 'index');
$router->get('/posts/create', 'PostController', 'create');
$router->post('/posts', 'PostController', 'store');
$router->get('/posts/{id}', 'PostController', 'show');
$router->get('/posts/{id}/edit', 'PostController', 'edit');
$router->post('/posts/{id}', 'PostController', 'update');
$router->post('/posts/{id}/delete', 'PostController', 'delete');

// API routes
$router->get('/api/posts', 'ApiController', 'posts');
$router->get('/api/posts/{id}', 'ApiController', 'post');
$router->post('/api/posts', 'ApiController', 'createPost');
$router->get('/api/users', 'ApiController', 'users');
$router->get('/api/users/{id}', 'ApiController', 'user');

// Match route
$route = $router->match();

if ($route) {
    $controllerName = "App\\Controllers\\{$route['controller']}";
    $action = $route['action'];
    $params = $router->getParams();

    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        
        if (method_exists($controller, $action)) {
            call_user_func_array([$controller, $action], [$params]);
        } else {
            die("Action {$action} not found in {$controllerName}");
        }
    } else {
        die("Controller {$controllerName} not found");
    }
} else {
    http_response_code(404);
    require __DIR__ . '/../views/errors/404.php';
}
