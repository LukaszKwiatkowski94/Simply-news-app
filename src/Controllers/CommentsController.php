<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Classes\Comment;
use APP\Controllers\AbstractController;
use APP\Models\CommentsModel;
use Exception;

/**
 * Class CommentsController
 *
 * @package APP\Controllers
 */
final class CommentsController extends AbstractController
{
    private CommentsModel $model;

    public function __construct($request)
    {
        $this->model = new CommentsModel();
        parent::__construct($request);
    }

    public function getComments($id): void
    {
        try {
            $comments = $this->model->getCommentsForNews((int)$id);
            header("Content-Type: application/json");
            $commentsArray = [];
            foreach ($comments as $comment) {
                $commentsArray[] = $comment->toArray();
            }
            echo json_encode($commentsArray);
            // exit();
        } catch (Exception $e) {
            throw new Exception("Error in get Comments | Controller Error", 400);
        }
    }

    public function createComment(): void
    {
        try {
            $data = $this->request->getRequestPost();
            $comment = new Comment(
                0,
                (int)$data['news'],
                self::$user->getUserId(),
                $data['content'],
                ''
            );
            $result = $this->model->createComment($comment);
        } catch (Exception $e) {
            throw new Exception("Error add comment | Controller Error", 400);
        }
    }
}
