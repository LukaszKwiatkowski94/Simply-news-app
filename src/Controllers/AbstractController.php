<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Models\AbstractModel;
use APP\Request;
use APP\View;

abstract class AbstractController
{
    protected const DEFAULT_PAGE = 'mainPage';
    private static array $configuration;
    public static string $myPage;
    public static $response;
    protected Request $request;
    protected View $view;

    public static function setConfiguration($configuration) : void
    {
        self::$configuration = $configuration;
        AbstractModel::configuration(self::$configuration);
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View();
    }

    public function run(): void
    {
        $requestPage = $this->getPage();
        if (!method_exists($this, $requestPage))
            $requestPage = 'pageNotFound';
        $this->$requestPage();
    }

    protected function getPage() : string
    {
        return self::$myPage ?? self::DEFAULT_PAGE;
    }

    private function pageNotFound(): void
    {
        $namePage = "pageNotFound";
        $params['header'] = "Page Not Found";
        $this->view->render($namePage,$params);
    }
}
