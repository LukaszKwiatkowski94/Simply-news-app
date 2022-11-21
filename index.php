<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/vendor/autoload.php';

use APP\Controllers\AbstractController;
use APP\Controllers\NewsController;
use APP\Controllers\UserController;
use APP\Models\AbstractModel;
use APP\Request;


$configuration = require_once("./config/config.php");

AbstractModel::configuration($configuration);

$klein = new \Klein\Klein();
$klein->respond('GET', '/', function () {
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'mainPage';
    (new NewsController($request))->run();
});

$klein->respond('GET', '/news-show/[:id]', function ($req) {
    $_GET['id'] = $req->id;
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'show';
    (new NewsController($request))->run();
});

$klein->respond('GET', '/news-create', function () {
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'create';
    (new NewsController($request))->run();
});

$klein->respond(array('GET','POST'), '/login', function ($req, $response) {
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'login';
    AbstractController::$response = $response;
    (new UserController($request))->run();
});

$klein->respond(array('GET','POST'), '/signup', function ($req, $response) {
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'signup';
    AbstractController::$response = $response;
    (new UserController($request))->run();
});

$klein->respond('GET', '/logout', function ($req, $response) {
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'logout';
    AbstractController::$response = $response;
    (new UserController($request))->run();
});

$klein->onHttpError(function ($code, $router) {
    $request = new Request($_GET,$_POST);
    AbstractController::$myPage = 'pageNotFound';
    (new NewsController($request))->run();
});

$klein->dispatch();
