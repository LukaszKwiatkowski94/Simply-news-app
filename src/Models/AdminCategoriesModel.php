<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use Exception;
use PDO;

final class AdminCategoriesModel extends AbstractModel
{
    /**
     * Get all categories with article count
     */
    public function getAllCategories(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT c.id, c.name, COUNT(n.id) as article_count 
                    FROM " . self::TABLE_CATEGORIES . " c
                    LEFT JOIN " . self::TABLE_NEWS . " n ON c.id = n.category_id
                    GROUP BY c.id
                    ORDER BY c.name ASC");
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories !== false ? $categories : [];
        } catch (Exception $e) {
            throw new Exception("Error fetching categories list. " . $e->getMessage(), 400);
        }
    }

    /**
     * Get category by ID
     */
    public function getCategoryById(int $id): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, name FROM " . self::TABLE_CATEGORIES . " WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            return $category !== false ? $category : [];
        } catch (Exception $e) {
            throw new Exception("Error fetching category. " . $e->getMessage(), 400);
        }
    }

    /**
     * Create new category
     */
    public function createCategory(string $name): int|null
    {
        try {
            if (empty($name)) {
                throw new Exception("Category name is required.", 400);
            }

            $stmt = $this->connection->prepare("INSERT INTO " . self::TABLE_CATEGORIES . " (name) 
                    VALUES(:name)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();

            $result = $this->connection->lastInsertId();
            if ($result === 0) {
                return null;
            }
            return (int)$result;
        } catch (Exception $e) {
            throw new Exception("Error creating category. | Database error.", 400);
        }
    }

    /**
     * Update category
     */
    public function updateCategory(int $id, string $name): bool
    {
        try {
            if (empty($name)) {
                throw new Exception("Category name is required.", 400);
            }

            $stmt = $this->connection->prepare("UPDATE " . self::TABLE_CATEGORIES . " 
                    SET name = :name 
                    WHERE id = :id");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error updating category. | Database error.", 400);
        }
    }

    /**
     * Delete category
     */
    public function deleteCategory(int $id): bool
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM " . self::TABLE_CATEGORIES . " WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error deleting category. | Database error.", 400);
        }
    }

    /**
     * Count total categories
     */
    public function countCategories(): int
    {
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) as count FROM " . self::TABLE_CATEGORIES);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)($result['count'] ?? 0);
        } catch (Exception $e) {
            throw new Exception("Error counting categories. | Database error.", 400);
        }
    }
}
