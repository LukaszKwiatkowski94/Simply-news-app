<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/vendor/autoload.php';
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

    $router->add(HttpMethod::GET, '/', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'mainPage';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::GET, '/news-show/{id}', function ($id) {
        $_GET['id'] = $id;
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'show';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::GET, '/news-create', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'create';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::POST, '/news-create', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'create';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::GET, '/news-list', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'list';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::GET, '/news-delete/{id}', function ($id) {
        $_GET['id'] = $id;
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'delete';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::GET, '/news-edit/{id}', function ($id) {
        $_GET['id'] = $id;
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'edit';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::POST, '/news-edit/{id}', function ($id) {
        $_GET['id'] = $id;
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'edit';
        (new NewsController($request))->run();
    });

    $router->add(HttpMethod::GET, '/login', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'login';
        (new UserController($request))->run();
    });

    $router->add(HttpMethod::POST, '/login', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'login';
        (new UserController($request))->run();
    });

    $router->add(HttpMethod::GET, '/signup', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'signup';
        (new UserController($request))->run();
    });

    $router->add(HttpMethod::POST, '/signup', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'signup';
        (new UserController($request))->run();
    });

    $router->add(HttpMethod::GET, '/logout', function () {
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'logout';
        (new UserController($request))->run();
    });

    $router->add(HttpMethod::GET, '/comments-news/{id}', function ($id) {
        $_GET['id'] = $id;
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'getComments';
        (new CommentsController($request))->run();
    });

    $router->add(HttpMethod::POST, '/comments-create', function () {
        $body = json_decode(file_get_contents('php://input'));
        $_POST['news'] = $body->news;
        $_POST['content'] = $body->content;
        $request = new Request($_GET, $_POST);
        AbstractController::$myPage = 'createComment';
        (new CommentsController($request))->run();
    });

    $router->dispatch();
} catch (Exception $e) {
    AbstractController::$myPage = 'error';
    (new ErrorController($e->getMessage()))->run();
}
