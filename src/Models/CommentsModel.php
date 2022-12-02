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
            $author = $this->connection->quote($data['author']);
            $content = $this->connection->quote($data['content']);
            $date_created = date('Y-m-d H:i:s');
            $query = "INSERT INTO 
            comments(author,content,date_created)
            VALUES($author,$content,$date_created)";
            $result = $this->connection->exec($query);
        }
        catch(Exception $e)
        {
            throw new CommentsException("Error in creating a comment | Database Error",400);
        }
    }

    public function getCommentsForNews(int $id): array
    {
        try
        {
            $query = "SELECT author, content, date_created FROM comments WHERE newsID=$id";
            $comments = $this->connection->query($query);
            return $comments->fetchAll(PDO::FETCH_ASSOC) ?? [];
        }
        catch(Exception $e)
        {
            throw new CommentsException("Error in getting a comments for News",400);
        }
    }
}