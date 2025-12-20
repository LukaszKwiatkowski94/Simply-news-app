<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Classes\News;
use APP\Controllers\AbstractController;
use APP\Models\NewsModel;
use Exception;

final class NewsController extends AbstractController
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
        $newsDb = $this->model->getNews();
        $listNews = [];
        foreach ($newsDb as $newsItem) {
            $listNews[] = $newsItem->toArray();
        }
        $params['posts'] = $listNews;
        $this->view->render($namePage, $params);
    }

    public function create(): void
    {
        if (!self::$user->isAdmin()) {
            throw new Exception("You don't have permissions. | Please contact your administrator.", 400);
        }
        if (!empty($this->request->getRequestPost())) {
            $data = $this->request->getRequestPost();
            $dataCreateNews = new News(
                0,
                $data['title'],
                $data['content'],
                self::$user->getUserId(),
                date('Y-m-d H:i:s'),
                true
            );
            $this->model->createNews($dataCreateNews);
            self::$response->redirect('/news-list');
        }
        $namePage = "create";
        $params['header'] = "Create News";
        $this->view->render($namePage, $params);
    }

    public function show($id): void
    {
        $namePage = "show";
        $post = $this->model->getSingleNews((int)$id);
        $params['header'] = $post->getTitle();
        $params['post'] = $post->toArray();
        if (empty($params['post'])) {
            throw new Exception('The requested news does not exist.', 400);
        }
        $this->view->render($namePage, $params);
    }

    public function list(): void
    {
        if (!self::$user->isAdmin()) {
            throw new Exception("You don't have permissions. | Please contact your administrator.", 400);
        }
        $namePage = "list";
        $params['header'] = "News List";
        $news = $this->model->getListNews();
        $listNews = [];
        foreach ($news as $newsItem) {
            $listNews[] = $newsItem->toArray();
        }
        $params['news'] = $listNews;
        $this->view->render($namePage, $params);
    }

    public function delete($id): void
    {
        try {
            if (!self::$user->isAdmin()) {
                throw new Exception("You don't have permissions. | Please contact your administrator.", 400);
            }
            $this->model->delete((int)$id);
            self::$response->redirect('/news-list');
        } catch (Exception  $e) {
            throw new Exception('Error deleting news', 400);
        }
    }

    public function edit($id): void
    {
        try {
            if (!self::$user->isAdmin()) {
                throw new Exception("You don't have permissions. | Please contact your administrator.", 400);
            }
            if (!empty($this->request->getRequestPost())) {
                $data = $this->request->getRequestPost();
                $news = new News(
                    (int)$data['id'],
                    $data['title'],
                    $data['content'],
                    0,
                    '',
                    $data['active'],
                    ''
                );
                $this->model->edit($news);
                self::$response->redirect('/news-list');
            }
            $namePage = "edit";
            $params['header'] = 'Edit News';
            $params['news'] = $this->model->getSingleNews((int)$id)->toArray();
            if (empty($params['news'])) {
                throw new Exception('The requested news does not exist.', 400);
            }
            $this->view->render($namePage, $params);
        } catch (Exception $e) {
            throw new Exception("News editing error", 400);
        }
    }
}
