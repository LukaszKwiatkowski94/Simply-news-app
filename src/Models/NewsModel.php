<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use Exception;
use PDO;

final class NewsModel extends AbstractModel
{
    public function createNews(array $data): void
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO SN_news(title, content, author, date_created, active) 
                    VALUES(:title, :content, :author, :date_created, :active)");
            $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindParam(':content', $data['content'], PDO::PARAM_STR);
            $stmt->bindParam(':author', $_SESSION['user']['id'], PDO::PARAM_INT);
            $stmt->bindParam(':date_created', date('Y-m-d H:i:s'), PDO::PARAM_STR);
            $active = true;
            $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Failed to create news. | Database error.', 400);
        }
    }

    public function getNews(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, title, CONCAT(LEFT(content,500),'...') AS content, date_created 
                    FROM SN_news 
                    WHERE active = true 
                    ORDER BY id desc");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (Exception $e) {
            throw new Exception('Failed to get news list. | Database error.', 400);
        }
    }

    public function getListNews(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT n.id AS id, n.title, n.date_created, n.date_last_updated, n.active, u.username AS author, c.name AS category 
                    FROM SN_news AS n
                    LEFT JOIN SN_users AS u ON n.author = u.id
                    LEFT JOIN SN_categories AS c ON n.id_category = c.id
                    ORDER BY id desc");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        } catch (Exception $e) {
            throw new Exception('Failed to get news list for admin. | Database error.', 400);
        }
    }

    public function getSingleNews(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT n.id, n.title, n.content, n.date_created, n.active, u.username AS author, c.name AS category
                    FROM SN_news as n
                    LEFT JOIN SN_users AS u ON n.author = u.id
                    LEFT JOIN SN_categories AS c ON n.id_category = c.id
                    WHERE n.id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            throw new Exception('Failed to get news. | Database error.', 400);
        }
    }

    public function delete(int $id): void
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM SN_news WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Failed to delete news. | Database error.', 400);
        }
    }

    public function edit(array $data): void
    {
        try {
            $stmt = $this->connection->prepare("UPDATE SN_news
                      SET title = :title,
                          content = :content,
                          date_last_updated = :date_last_updated,
                          active = :active
                      WHERE id = :id");
            $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindParam(':content', $data['content'], PDO::PARAM_STR);
            $dateLastUpdated = date('Y-m-d H:i:s');
            $stmt->bindParam(':date_last_updated', $dateLastUpdated, PDO::PARAM_STR);
            $active = ($data['active'] == 'on') ? 1 : 0;
            $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Failed to edit news. | Database error.", 400);
        }
    }
}
