<?php

declare(strict_types=1);

namespace APP;

require_once("./src/DataBase.php");
require_once("./src/View.php");

class Controller
{
    private static array $configuration;
    private const DEFAULT_PAGE = 'main';
    private DataBase $database;
    private array $request;
    private View $view;

    public static function setConfiguration($configuration) : void
    {
        self::$configuration = $configuration;
    }

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->view = new View();
        $this->database = new DataBase(self::$configuration['db']);
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
                $params['posts'] = $this->database->getPosts();
                break;
            case 'createPost':
                if(!empty($this->getRequestPost()))
                {
                    $data = $this->getRequestPost();
                    $dataCreatePost = [
                        'title' => $data['title'],
                        'content' => $data['content']
                    ];
                    $this->database->createPost($dataCreatePost);
                }
                $namePage = "create";
                $params['header'] = "Create Post";
                break;
            case 'post':
                $namePage = "post";
                $idPost = ($this->getRequestGet());
                $params['header'] = ($this->database->getPost((int)$idPost['id']))['title'];
                $params['post'] = $this->database->getPost((int)$idPost['id']);
                break;
            default:
                $namePage = "pageNotFound";
                $params['header'] = "Page Not Found";
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