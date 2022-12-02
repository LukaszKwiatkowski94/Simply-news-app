<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Exception\CommentsException;
use APP\Models\CommentsModel;
use Exception;

class CommentsController extends AbstractController
{
    private CommentsModel $model;

    public function __construct($request)
    {
        $this->model = new CommentsModel();
        parent::__construct($request);
    }

    public function getComments()
    {
        try
        {
            $data = $this->request->getRequestGet();
            $id = $data['id'];
            $comments = $this->model->getCommentsForNews($id);
            return  json_encode($comments);
        }
        catch(Exception $e)
        {
            throw new CommentsException("Error in get Comments | Controller Error",400);        
        }
    }

    public function createComment(): void
    {
        try
        {
            $data = $this->request->getRequestPost();
            $dataComment = [
                'author' => $data['author'],
                'content' => $data['content'],
                'date_created' => $data['date_created']
            ];
            $result = $this->model->createComment($dataComment);
        }
        catch(Exception $e)
        {
            throw new CommentsException("Error add comment | Controller Error",400);
        }
    }
}