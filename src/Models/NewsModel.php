<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Classes\News;
use APP\Models\AbstractModel;
use Exception;
use PDO;

final class NewsModel extends AbstractModel
{
    /**
     * @param News $news
     * @return void
     */
    public function createNews(News $news): void
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO SN_news(title, content, author, date_created, active) 
                    VALUES(:title, :content, :author, now(), :active)");
            $stmt->bindParam(':title', $news->getTitle(), PDO::PARAM_STR);
            $stmt->bindParam(':content', $news->getContent(), PDO::PARAM_STR);
            $stmt->bindParam(':author', $news->getAuthorId(), PDO::PARAM_INT);
            $stmt->bindParam(':active', $news->isActive(), PDO::PARAM_BOOL);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception('Failed to create news. | Database error.', 400);
        }
    }

    /**
     * @return News[]
     */
    public function getNews(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, title, CONCAT(LEFT(content,500),'...') AS content, date_created 
                    FROM SN_news 
                    WHERE active = true 
                    ORDER BY id desc");
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $postList = [];
            foreach ($posts as $post) {
                $postList[] = new News(
                    (int)$post['id'],
                    $post['title'],
                    $post['content'],
                    0,
                    $post['date_created'],
                    true
                );
            }
            return $postList;
        } catch (Exception $e) {
            throw new Exception('Failed to get news list. | Database error.', 400);
        }
    }

    /**
     * @return News[]
     */
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
            $listPosts = [];
            foreach ($posts as $post) {
                $listPosts[] = new News(
                    (int)$post['id'],
                    $post['title'],
                    '',
                    0,
                    $post['date_created'],
                    (bool)$post['active'],
                    $post['date_last_updated'],
                    $post['author'],
                    $post['category']
                );
            }
            return $listPosts;
        } catch (Exception $e) {
            throw new Exception('Failed to get news list for admin. | Database error.', 400);
        }
    }

    /**
     * @param int $id
     * @return News
     */
    public function getSingleNews(int $id): News
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
            $post = new News(
                (int)$result['id'],
                $result['title'],
                $result['content'],
                0,
                $result['date_created'],
                (bool)$result['active'],
                $result['date_last_updated'] ?? '',
                $result['author'],
                $result['category']
            );
            return $post;
        } catch (Exception $e) {
            throw new Exception('Failed to get news. | Database error.', 400);
        }
    }

    /**
     * @param int $id
     * @return void
     */
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

    /**
     * @param News $news
     * @return void
     */
    public function edit(News $news): void
    {
        try {
            $stmt = $this->connection->prepare("UPDATE SN_news
                      SET title = :title,
                          content = :content,
                          date_last_updated = now(),
                          active = :active
                      WHERE id = :id");
            $stmt->bindParam(':title', $news->getTitle(), PDO::PARAM_STR);
            $stmt->bindParam(':content', $news->getContent(), PDO::PARAM_STR);
            $stmt->bindParam(':active', $news->isActive(), PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $news->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Failed to edit news. | Database error.", 400);
        }
    }
}
