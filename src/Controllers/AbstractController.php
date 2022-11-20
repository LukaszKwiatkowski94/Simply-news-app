<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Models\AbstractModel;
use APP\Request;
use APP\View;

abstract class AbstractController
{
    private static array $configuration;
    protected const DEFAULT_PAGE = 'mainPage';
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
        $this->$requestPage();
    }

    protected function getPage() : string
    {
        $myGet = $this->request->getRequestGet();
        return $myGet['action'] ?? self::DEFAULT_PAGE;
    }
}
