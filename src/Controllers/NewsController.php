<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Models\NewsModel;

class NewsController extends AbstractController
{
    private NewsModel $model;

    public function __construct($request)
    {
        $this->model = new NewsModel();
        parent::__construct($request);
    }

    public function mainPage(): void
    {
        $namePage = "main";
        $params['header'] = "Main Page";
        $params['posts'] = $this->model->getNews();
        $this->view->render($namePage,$params);
    }

    public function create(): void
    {
        if(!empty($this->request->getRequestGet()))
        {
            $data = $this->request->getRequestGet();
            $dataCreatePost = [
                'title' => $data['title'],
                'content' => $data['content']
            ];
            $this->model->createNews($dataCreatePost);
        }
        $namePage = "create";
        $params['header'] = "Create Post";
        $this->view->render($namePage,$params);
    }

    public function show(): void
    {
        $namePage = "post";
        $idPost = ($this->request->getRequestGet());
        $params['header'] = ($this->model->getSingleNews((int)$idPost['id']))['title'];
        $params['post'] = $this->model->getSingleNews((int)$idPost['id']);
        $this->view->render($namePage,$params);
    }
}