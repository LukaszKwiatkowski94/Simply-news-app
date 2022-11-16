<?php

declare(strict_types=1);

namespace APP;

require_once("./src/View.php");

class Controller
{
    private const DEFAULT_PAGE = 'main';
    private array $request;
    private View $view;

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->view = new View();
    }

    public function run() : void
    {
        $params = [];
        $getPage = $this->getPage();

        switch($getPage)
        {
            case 'main':
                $namePage = "main";
                $params['header'] = "Main Page";
                break;
            case 'createPost':
                $namePage = "create";
                $params['header'] = "Create Post";
                break;
            default:
                $namePage = "other";
                $params['header'] = "Other Page";
                break;
        }
        
        $this->view->render($namePage,$params);
    }

    private function getPage() : string
    {
        $myGet = $this->getRequestGet();
        return $myGet['action'] ?? self::DEFAULT_PAGE;
    }

    private function getRequestGet() : array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost() : array
    {
        return $this->request['post'] ?? [];
    }

}