<?php

declare(strict_types=1);

namespace APP\Models;


class CategoriesModel extends AbstractModel
{
    public function list(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM SN_categories");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(string $name): void
    {
        $nameQuoted = $this->connection->quote($name);
        $query = "INSERT INTO SN_categories(name) VALUES($nameQuoted)";
        $this->connection->exec($query);
    }

    public function update(int $id, string $name, bool $isActive): void
    {
        $nameQuoted = $this->connection->quote($name);
        $query = "UPDATE SN_categories SET name=$nameQuoted, isActive=" . ($isActive ? '1' : '0') . " WHERE id=$id";
        $this->connection->exec($query);
    }
}
