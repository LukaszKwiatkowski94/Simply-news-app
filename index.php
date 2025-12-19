<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/config/autoload.php';
require_once __DIR__ . '/config/env.php';

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
    $configuration = require_once("./config/config.php");

    AbstractModel::configuration($configuration);


    // require_once __DIR__ . '/src/routes.php';

    $router = new Router();
    $request = new Request($_GET, $_POST);

    $router->add(HttpMethod::GET, '/', [new NewsController($request), 'mainPage']);
    $router->add(HttpMethod::GET, '/news-show/{id}', [new NewsController($request), 'show']);
    $router->add(HttpMethod::GET, '/news-create', [new NewsController($request), 'create']);
    $router->add(HttpMethod::POST, '/news-create', [new NewsController($request), 'create']);
    $router->add(HttpMethod::GET, '/news-list', [new NewsController($request), 'list']);
    $router->add(HttpMethod::GET, '/news-delete/{id}', [new NewsController($request), 'delete']);
    $router->add(HttpMethod::GET, '/news-edit/{id}', [new NewsController($request), 'edit']);
    $router->add(HttpMethod::POST, '/news-edit/{id}', [new NewsController($request), 'edit']);
    $router->add(HttpMethod::GET, '/login', [new UserController($request), 'login']);
    $router->add(HttpMethod::POST, '/login', [new UserController($request), 'login']);
    $router->add(HttpMethod::GET, '/signup', [new UserController($request), 'signup']);
    $router->add(HttpMethod::POST, '/signup', [new UserController($request), 'signup']);
    $router->add(HttpMethod::GET, '/logout', [new UserController($request), 'logout']);
    $router->add(HttpMethod::GET, '/comments-news/{id}', [new CommentsController($request), 'getComments']);
    $router->add(HttpMethod::POST, '/comments-create', [new CommentsController($request), 'createComment']);

    $router->dispatch();
} catch (Exception $e) {
    AbstractController::$myPage = 'error';
    (new ErrorController($e->getMessage()))->run();
}
