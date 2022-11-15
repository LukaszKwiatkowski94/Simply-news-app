<?php

declare(strict_types=1);
namespace APP;
require_once("./src/View.php");

const DEFAULT_PAGE = 'main';

$getPage = $_GET['action'] ?? DEFAULT_PAGE;

$view = new View();

$params = [];

if($getPage==="main"){
    $namePage = "main";
    $params['header'] = "Main Page";
}else{
    $namePage = "other";
    $params['header'] = "Other Page";
}

$view->render($namePage,$params);
