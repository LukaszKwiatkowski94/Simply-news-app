<?php

use APP\Models\AbstractModel;

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/env.php';
$configuration = require_once("database.php");
AbstractModel::configuration($configuration);
