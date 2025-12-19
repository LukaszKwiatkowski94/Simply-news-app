<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Models\AbstractModel;
use APP\Request;
use APP\Response;
use APP\User;
use APP\View;

abstract class AbstractController
{
    protected const DEFAULT_PAGE = 'mainPage';
    private static array $configuration;
    public static string $myPage;
    protected static $response;
    protected static User $user;
    protected Request $request;
    protected View $view;

    public static function setConfiguration($configuration): void
    {
        self::$configuration = $configuration;
        AbstractModel::configuration(self::$configuration);
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
        self::$response = new Response();
        self::$user = new User();
        $this->view = new View(self::$user);
    }

    public function run(): void
    {
        $requestPage = $this->getPage();
        if (!method_exists($this, $requestPage))
            $requestPage = 'pageNotFound';
        $this->$requestPage();
    }

    protected function getPage(): string
    {
        return self::$myPage ?? self::DEFAULT_PAGE;
    }

    private function pageNotFound(): void
    {
        $namePage = "pageNotFound";
        $params['header'] = "Page Not Found";
        $this->view->render($namePage, $params);
    }
}
