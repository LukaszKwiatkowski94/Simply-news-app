<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use PDO;

class NewsModel extends AbstractModel
{
    public function createNews(array $data): void
    {
        $title = $this->connection->quote($data['title']);
        $content = $this->connection->quote($data['content']);
        $author = 1;
        $date_created = date('Y-m-d H:i:s');
        $active = true;
        $query = "INSERT INTO 
        news(title,content,author,date_created,active) 
        VALUES($title,$content,$author,'$date_created',$active)";
        $result = $this->connection->exec($query);
    }

    public function getNews(): array
    {
        $query = "SELECT id, title, CONCAT(LEFT(content,500),'...') AS content, date_created FROM news WHERE active = true ORDER BY id desc";
        $posts = $this->connection->query($query);
        $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getSingleNews(int $id)
    {
        $query = "SELECT id, title, content, date_created, author FROM news WHERE id=$id";
        $post = $this->connection->query($query);
        $result = $post->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}