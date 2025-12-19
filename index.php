<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/config/configuration.php';

use APP\Controllers\AbstractController;
use APP\Controllers\CommentsController;
use APP\Controllers\ErrorController;
use APP\Controllers\NewsController;
use APP\Controllers\UserController;
use APP\HttpMethod;
use APP\Models\AbstractModel;
use APP\Request;
use APP\Router;

try {

    // require_once __DIR__ . '/src/routes.php';

    $router = new Router();
    $router->add(HttpMethod::GET, '/', NewsController::class, 'mainPage');
    $router->add(HttpMethod::GET, '/news-show/{id}', NewsController::class, 'show');
    $router->add(HttpMethod::GET, '/news-create', NewsController::class, 'create');
    $router->add(HttpMethod::POST, '/news-create', NewsController::class, 'create');
    $router->add(HttpMethod::GET, '/news-list', NewsController::class, 'list');
    $router->add(HttpMethod::GET, '/news-delete/{id}', NewsController::class, 'delete');
    $router->add(HttpMethod::GET, '/news-edit/{id}', NewsController::class, 'edit');
    $router->add(HttpMethod::POST, '/news-edit/{id}', NewsController::class, 'edit');
    $router->add(HttpMethod::GET, '/login', UserController::class, 'logIn');
    $router->add(HttpMethod::POST, '/login', UserController::class, 'logIn');
    $router->add(HttpMethod::GET, '/signup', UserController::class, 'signUp');
    $router->add(HttpMethod::POST, '/signup', UserController::class, 'signUp');
    $router->add(HttpMethod::GET, '/logout', UserController::class, 'logOut');
    $router->add(HttpMethod::GET, '/comments-news/{id}', CommentsController::class, 'getComments');
    $router->add(HttpMethod::POST, '/comments-create', CommentsController::class, 'createComment');
    $router->dispatch();
} catch (Exception $e) {
    AbstractController::$myPage = 'error';
    (new ErrorController($e->getMessage()))->run();
}
