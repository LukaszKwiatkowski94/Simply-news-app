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
            $stmt = $this->connection->prepare("INSERT INTO SN_news(title, content, user_id, category_id) 
                    VALUES(:title, :content, :user_id, :category_id)");
            $stmt->bindParam(':title', $news->getTitle(), PDO::PARAM_STR);
            $stmt->bindParam(':content', $news->getContent(), PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $news->getAuthorId(), PDO::PARAM_INT);
            $stmt->bindParam(':category_id', 0, PDO::PARAM_INT);
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
            $stmt = $this->connection->prepare("SELECT id, title, CONCAT(LEFT(content,500),'...') AS content, created_at 
                    FROM SN_news 
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
                    $post['created_at'],
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
            $stmt = $this->connection->prepare("SELECT n.id AS id, n.title, n.created_at, n.updated_at, u.username AS author, c.name AS category 
                    FROM SN_news AS n
                    LEFT JOIN SN_users AS u ON n.user_id = u.id
                    LEFT JOIN SN_categories AS c ON n.category_id = c.id
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
                    $post['created_at'],
                    true,
                    $post['updated_at'],
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
            $stmt = $this->connection->prepare("SELECT n.id, n.title, n.content, n.created_at, n.updated_at, u.username AS author, c.name AS category
                    FROM SN_news as n
                    LEFT JOIN SN_users AS u ON n.user_id = u.id
                    LEFT JOIN SN_categories AS c ON n.category_id = c.id
                    WHERE n.id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $post = new News(
                (int)$result['id'],
                $result['title'],
                $result['content'],
                0,
                $result['created_at'],
                true,
                $result['updated_at'],
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
                          content = :content
                      WHERE id = :id");
            $stmt->bindParam(':title', $news->getTitle(), PDO::PARAM_STR);
            $stmt->bindParam(':content', $news->getContent(), PDO::PARAM_STR);
            $stmt->bindParam(':id', $news->getId(), PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Failed to edit news. | Database error.", 400);
        }
    }
}
