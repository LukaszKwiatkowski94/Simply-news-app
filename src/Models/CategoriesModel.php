<?php

declare(strict_types=1);

namespace APP\Models;


final class CategoriesModel extends AbstractModel
{
    public function list(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM SN_categories");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(string $name): void
    {
        $stmt = $this->connection->prepare("INSERT INTO SN_categories(name) VALUES(:name)");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function update(int $id, string $name, bool $isActive): void
    {
        $stmt = $this->connection->prepare("UPDATE SN_categories SET name=:name, is_active=:is_active WHERE id=:id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':is_active', $isActive, \PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
