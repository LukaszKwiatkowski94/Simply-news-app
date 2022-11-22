<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\View;

class ErrorController extends AbstractController
{
    private string $message;
    public function __construct(?string $message)
    {
        $this->view = new View();
        $this->message = $message;
    }

    public function error(): void
    {
        $params['header'] = 'Server Error';
        $params['message'] = $this->message ?? 'Server operation problem. Please contact your administrator.';
        $this->view->render('error',$params);
    }
}