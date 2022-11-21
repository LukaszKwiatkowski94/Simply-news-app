<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Models\UserModel;

class UserController extends AbstractController
{
    private UserModel $model;

    public function __construct($request)
    {
        $this->model = new UserModel();
        parent::__construct($request);
    }
}