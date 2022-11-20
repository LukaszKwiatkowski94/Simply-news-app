<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use APP\Controllers\NewsController;
use APP\Models\AbstractModel;
use APP\Request;

$configuration = require_once("./config/config.php");

$request = new Request($_GET,$_POST);

AbstractModel::configuration($configuration);
(new NewsController($request))->run();