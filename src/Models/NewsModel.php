<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Exception\NewsException;
use APP\Models\AbstractModel;
use Exception;
use PDO;

class NewsModel extends AbstractModel
{
    public function createNews(array $data): void
    {
        try {
            $title = $this->connection->quote($data['title']);
            $content = $this->connection->quote($data['content']);
            $author = $_SESSION['user']['id'];
            $date_created = date('Y-m-d H:i:s');
            $active = true;
            $query = "INSERT INTO 
            SN_news(title,content,author,date_created,active) 
            VALUES($title,$content,$author,'$date_created',$active)";
            $result = $this->connection->exec($query);
        } catch (Exception $e) {
            throw new NewsException('Failed to create news. | Database error.', 400);
        }
    }

    public function getNews(): array
    {
        try {
            $query = "SELECT id, title, CONCAT(LEFT(content,500),'...') AS content, date_created FROM SN_news WHERE active = true ORDER BY id desc";
            $posts = $this->connection->query($query);
            $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (Exception $e) {
            throw new NewsException('Failed to get news list. | Database error.', 400);
        }
    }

    public function getListNews(): array
    {
        try {
            $query = "SELECT id, title, date_created, date_last_updated, active FROM SN_news ORDER BY id desc";
            $posts = $this->connection->query($query);
            $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (Exception $e) {
            throw new NewsException('Failed to get news list for admin. | Database error.', 400);
        }
    }

    public function getSingleNews(int $id)
    {
        try {
            $query = "SELECT id, title, content, date_created, author, active FROM SN_news WHERE id=$id";
            $post = $this->connection->query($query);
            $result = $post->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            throw new NewsException('Failed to get news. | Database error.', 400);
        }
    }

    public function delete(int $id): void
    {
        try {
            $query = "DELETE FROM news where id=$id";
            $this->connection->exec($query);
        } catch (Exception $e) {
            throw new NewsException('Failed to delete news. | Database error.', 400);
        }
    }

    public function edit(array $data): void
    {
        try {
            $id = $data['id'];
            $title = $this->connection->quote($data['title']);
            $content = $this->connection->quote($data['content']);
            $dateLastUpdated = date('Y-m-d H:i:s');
            $active = ($data['active'] == 'on') ? 1 : 0;
            $query = "UPDATE SN_news
                      SET title = $title,
                          content = $content,
                          date_last_updated = '$dateLastUpdated',
                          active = $active
                      WHERE id=$id";
            $result = $this->connection->exec($query);
        } catch (Exception $e) {
            throw new NewsException("Failed to edit news. | Database error.", 400);
        }
    }
}
