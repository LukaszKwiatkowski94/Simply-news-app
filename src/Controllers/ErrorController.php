<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\View;

final class ErrorController extends AbstractController
{
    private string $message;
    private int $code;

    public function __construct(string $message, int $code)
    {
        $this->view = new View();
        $this->message = $message;
        $this->code = $code;
    }

    public function error(): void
    {
        $params['header'] = $this->code === 404 ? 'Page Not Found' : 'Error';
        $params['message'] = $this->message ?? 'Server operation problem. Please contact your administrator.';
        $params['code'] = $this->code ?? 500;
        $this->view->render('error', $params);
    }
}
