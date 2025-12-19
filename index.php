<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/config/configuration.php';

use APP\Controllers\ErrorController;
use APP\Router;

try {
    $router = new Router;
    $registerRoutes = require __DIR__ . '/config/routes.php';
    $registerRoutes($router);
    $router->dispatch();
} catch (Exception $e) {
    (new ErrorController($e->getMessage(), $e->getCode()))->error();
}
