<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Exception\NewsException;
use APP\Exception\PermissionException;
use APP\Models\NewsModel;
use Exception;

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
        if($_SESSION['user']['is_admin'] == 0){
            throw new PermissionException("You don't have permissions. | Please contact your administrator.",400);
        }
        if(!empty($this->request->getRequestPost()))
        {
            $data = $this->request->getRequestPost();
            $dataCreateNews = [
                'title' => $data['title'],
                'content' => $data['content']
            ];
            $this->model->createNews($dataCreateNews);
        }
        $namePage = "create";
        $params['header'] = "Create News";
        $this->view->render($namePage,$params);
    }

    public function show(): void
    {
        $namePage = "show";
        $idNews = ($this->request->getRequestGet());
        $params['header'] = ($this->model->getSingleNews((int)$idNews['id']))['title'];
        $params['post'] = $this->model->getSingleNews((int)$idNews['id']);
        if(empty($params['post']))
        {
            throw new NewsException('The requested news does not exist.',400);
        }
        $this->view->render($namePage,$params);
    }

    public function list(): void
    {
        if($_SESSION['user']['is_admin'] == 0){
            throw new PermissionException("You don't have permissions. | Please contact your administrator.",400);
        }
        $namePage = "list";
        $params['header'] = "Main Page";
        $params['news'] = $this->model->getListNews();
        $this->view->render($namePage,$params);
    }

    public function delete(): void
    {
        try
        {
            if($_SESSION['user']['is_admin'] == 0){
                throw new PermissionException("You don't have permissions. | Please contact your administrator.",400);
            }
            $idNews = ($this->request->getRequestGet());
            $this->model->delete((int)$idNews['id']);
            self::$response->redirect('/news-list')->send();
        }
        catch(Exception)
        {
            throw new NewsException('Error deleting news',400);
        }
    }

    public function edit():void
    {
        try
        {
            if($_SESSION['user']['is_admin'] == 0){
                throw new PermissionException("You don't have permissions. | Please contact your administrator.",400);
            }
            if(!empty($this->request->getRequestPost()))
            {
                $data = $this->request->getRequestPost();
                $dataCreateNews = [
                    'id' => $data['id'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'active' => $data['active']
                ];
                $this->model->edit($dataCreateNews);
                self::$response->redirect('/news-list')->send();
            }
            $namePage = "edit";
            $idNews = ($this->request->getRequestGet());
            $params['header'] = 'Edit News';
            $params['news'] = $this->model->getSingleNews((int)$idNews['id']);
            if(empty($params['news']))
            {
                throw new NewsException('The requested news does not exist.',400);
            }
            $this->view->render($namePage,$params);
        }
        catch(Exception $e)
        {
            throw new NewsException("News editing error - $e",400);
        }
    }
}