<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Classes\Comment;
use APP\Models\AbstractModel;
use Exception;
use PDO;

final class CommentsModel extends AbstractModel
{
    public function createComment(Comment $comment): void
    {
        try {

            $stmt = $this->connection->prepare("INSERT INTO SN_comments(newsID, authorID, content, now()) 
                    VALUES(:newsID, :authorID, :content)");
            $stmt->bindParam(':newsID', $comment->getNewsID(), PDO::PARAM_INT);
            $stmt->bindParam(':authorID', $comment->getAuthorID(), PDO::PARAM_INT);
            $stmt->bindParam(':content', $comment->getContent(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            file_put_contents('./log_' . date("j.n.Y") . '.log', $e->getMessage(), FILE_APPEND);
            throw new Exception("Error in creating a comment | Database Error", 400);
        }
    }

    public function getCommentsForNews(int $id): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT u.username as author, c.content, c.date_created 
                    FROM SN_comments c JOIN SN_users u ON c.authorID = u.id
                    WHERE newsID=:newsID");
            $stmt->bindParam(':newsID', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
        } catch (Exception $e) {
            throw new Exception("Error in getting a comments for News", 400);
        }
    }
}
