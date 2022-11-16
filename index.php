<?php

declare(strict_types=1);

namespace APP;

require_once("./src/Controller.php");
$configuration = require_once("./config/config.php");

$request = [
    'get' => $_GET,
    'post' => $_POST
];

Controller::setConfiguration($configuration);
(new Controller($request))->run();