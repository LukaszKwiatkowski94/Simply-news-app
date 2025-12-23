<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use Exception;
use PDO;

final class UserModel extends AbstractModel
{

    public function create(array $data): int|null
    {
        try {
            if (empty($data['username']) || empty($data['password']) || empty($data['name']) || empty($data['surname'])) {
                throw new Exception("Incomplete user creation data. | Database error.", 400);
            }
            $stmt = $this->connection->prepare("INSERT INTO " . self::TABLE_USERS . " (username, password, name, surname) 
                    VALUES(:username, :password, :name, :surname)");
            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
            $stmt->execute();
            $result = $this->connection->lastInsertId();
            if ($result === 0) {
                return null;
            } else {
                $result = (int)$result;
            }
            return $result;
        } catch (Exception $e) {
            throw new Exception("User creation error. | Database error.", 400);
        }
    }

    public function get(array $data): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT * 
                    FROM " . self::TABLE_USERS . " 
                    WHERE username = :username");
            $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
            $stmt->execute();
            $getUser = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
            $password = isset($data['password']) ? $data['password'] : null;
            if (isset($getUser)) {
                if (password_verify($password, $getUser['password'])) {
                    return $getUser;
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw new Exception("Error while logging in. Check the correctness of the data and log in again. | DataBase Error", 400);
        }
    }

    public function getUserById(int $id): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, username, name, surname, is_admin, active 
                    FROM " . self::TABLE_USERS . " 
                    WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $getUser = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
            return $getUser;
        } catch (Exception $e) {
            throw new Exception("Error while fetching user by ID. | Database error.", 400);
        }
    }
}
