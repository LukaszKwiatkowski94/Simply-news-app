<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Exception\CommentsException;
use APP\Models\AbstractModel;
use Exception;
use PDO;

class CommentsModel extends AbstractModel
{
    public function createComment(array $data): void
    {        
        try
        {
            $idNews = $this->connection->quote($data['newsID']);
            $author = $this->connection->quote($data['authorID']);
            $content = $this->connection->quote($data['content']);
            $date_created = date('Y-m-d H:i:s');
            $query = "INSERT INTO comments(newsID, authorID, content, date_created) VALUES($idNews,$author,$content,'$date_created')";
            $result = $this->connection->exec($query);
        }
        catch(Exception $e)
        {
            file_put_contents('./log_'.date("j.n.Y").'.log', $e->getMessage(), FILE_APPEND);
            throw new CommentsException("Error in creating a comment | Database Error",400);
        }
    }

    public function getCommentsForNews(int $id): array
    {
        try
        {
            $query = "SELECT u.username as author, c.content, c.date_created 
                    FROM comments c JOIN users u ON c.authorID = u.id
                    WHERE newsID=$id";
            $comments = $this->connection->query($query);
            $comments = $comments->fetchAll(PDO::FETCH_ASSOC) ?? [];
            return $comments;
        }
        catch(Exception $e)
        {
            throw new CommentsException("Error in getting a comments for News",400);
        }
    }
}