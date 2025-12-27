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

    public function render($page, $params): void
    {
        // Jeśli $params['page'] jest ustawiony, użyj go (dla adminów i nowych kontrolerów)
        // W przeciwnym razie użyj $page (dla starych kontrolerów)
        $templatePage = $params['page'] ?? $page;
        
        // Extract $params to make all keys available as variables in included templates
        extract($params, EXTR_SKIP);

        include_once(__DIR__ . '/../templates/base.php');
    }
}
