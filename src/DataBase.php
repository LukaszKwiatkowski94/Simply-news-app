<?php

declare(strict_types=1);

namespace APP;

use PDO;

class DataBase
{
    private PDO $connection;

    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};port={$config['port']}";
        $this->connection = new PDO($dsn, $config['user'], $config['password']);
    }

    public function createPost(array $data): void
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

    public function getPosts(): array
    {
        $query = 'SELECT * FROM news';
        $posts = $this->connection->query($query);
        $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    public function getPost(int $id)
    {
        $query = "SELECT * FROM news WHERE id=$id";
        $post = $this->connection->query($query);
        $result = $post->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}