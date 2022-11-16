<?php
declare(strict_types=1);
namespace APP;

class View{

    public function render($page, $params)
    {
        include_once("./templates/base.php");
    }
}