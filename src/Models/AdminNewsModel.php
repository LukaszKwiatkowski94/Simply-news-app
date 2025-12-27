<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use Exception;
use PDO;

final class AdminNewsModel extends AbstractModel
{
    /**
     * Get all news articles with full details
     */
    public function getAllNews(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT n.id, n.title, n.content, n.user_id, n.category_id, n.created_at, n.updated_at, 
                    u.username as author_name, c.name as category
                    FROM " . self::TABLE_NEWS . " n
                    LEFT JOIN " . self::TABLE_USERS . " u ON n.user_id = u.id
                    LEFT JOIN " . self::TABLE_CATEGORIES . " c ON n.category_id = c.id
                    ORDER BY n.created_at DESC");
            $stmt->execute();
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $articles === false ? [] : $articles;
        } catch (Exception $e) {
            throw new Exception("Error fetching articles list. " . $e->getMessage(), 400);
        }
    }

    /**
     * Get single news article by ID
     */
    public function getNewsById(int $id): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, title, content, user_id, category_id, created_at, updated_at 
                    FROM " . self::TABLE_NEWS . " 
                    WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
            return $article !== false ? $article : [];
        } catch (Exception $e) {
            throw new Exception("Error fetching article. | Database error.", 400);
        }
    }

    /**
     * Count total articles
     */
    public function countArticles(): int
    {
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) as count FROM " . self::TABLE_NEWS);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)($result['count'] ?? 0);
        } catch (Exception $e) {
            throw new Exception("Error counting articles. | Database error.", 400);
        }
    }
}
