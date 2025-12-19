<?php

declare(strict_types=1);

namespace APP;

final class View
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function render($page, $params)
    {
        include_once(__DIR__ . '/../templates/base.php');
    }
}
