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
use APP\Router;

try {
    $router = new Router();
    $registerRoutes = require __DIR__ . '/config/routes.php';
    $registerRoutes($router);
    $router->dispatch();
} catch (Exception $e) {
    AbstractController::$myPage = 'error';
    (new ErrorController($e->getMessage()))->run();
}
