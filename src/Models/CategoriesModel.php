<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Classes\Category;

final class CategoriesModel extends AbstractModel
{
    public function list(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM SN_categories");
        $stmt->execute();
        $categories = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $category) {
            $categories[] = new Category(
                (int)$category['id'],
                $category['name'],
                (bool)$category['is_active']
            );
        }
        return $categories;
    }

    public function create(string $name): void
    {
        $stmt = $this->connection->prepare("INSERT INTO SN_categories(name) VALUES(:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function update(Category $category): void
    {
        $stmt = $this->connection->prepare("UPDATE SN_categories SET name=:name, is_active=:is_active WHERE id=:id");
        $stmt->bindParam(':name', $category->getName());
        $stmt->bindParam(':is_active', $category->isActive(), \PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $category->getId(), \PDO::PARAM_INT);
        $stmt->execute();
    }
}
