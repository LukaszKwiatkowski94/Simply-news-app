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

    public function getComments($id)
    {
        try {
            $comments = $this->model->getCommentsForNews((int)$id);
            header("Content-Type: application/json");
            echo json_encode($comments);
            // exit();
        } catch (Exception $e) {
            throw new CommentsException("Error in get Comments | Controller Error", 400);
        }
    }

    public function createComment(): void
    {
        try {
            $data = $this->request->getRequestPost();
            $dataComment = [
                'authorID' => self::$user->getUserId(),
                'newsID' => $data['news'],
                'content' => $data['content']
            ];
            $result = $this->model->createComment($dataComment);
        } catch (Exception $e) {
            throw new CommentsException("Error add comment | Controller Error", 400);
        }
    }
}
