<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use Exception;
use PDO;

final class AdminUsersModel extends AbstractModel
{
    /**
     * Get all users with their details
     */
    public function getAllUsers(): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, username, name, surname, is_admin, active 
                    FROM " . self::TABLE_USERS . " 
                    ORDER BY id DESC");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
            return $users;
        } catch (Exception $e) {
            throw new Exception("Error fetching users list. | Database error.", 400);
        }
    }

    /**
     * Get user by ID
     */
    public function getUserById(int $id): array
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, username, name, surname, is_admin, active 
                    FROM " . self::TABLE_USERS . " 
                    WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
            return $user;
        } catch (Exception $e) {
            throw new Exception("Error fetching user by ID. | Database error.", 400);
        }
    }

    /**
     * Toggle user admin role (0 -> 1 or 1 -> 0)
     */
    public function toggleAdminRole(int $userId): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE " . self::TABLE_USERS . " 
                    SET is_admin = IF(is_admin = 1, 0, 1) 
                    WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error updating user role. | Database error.", 400);
        }
    }

    /**
     * Toggle user active status (block/unblock)
     * active = 1 means user is active, active = 0 means user is blocked
     */
    public function toggleUserStatus(int $userId): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE " . self::TABLE_USERS . " 
                    SET active = IF(active = 1, 0, 1) 
                    WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error updating user status. | Database error.", 400);
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(int $userId): bool
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM " . self::TABLE_USERS . " 
                    WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error deleting user. | Database error.", 400);
        }
    }

    /**
     * Reset user password to temporary (admin action)
     * TODO: Implement password reset functionality
     */
    public function resetUserPassword(int $userId, string $tempPassword): bool
    {
        try {
            $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);
            $stmt = $this->connection->prepare("UPDATE " . self::TABLE_USERS . " 
                    SET password = :password 
                    WHERE id = :id");
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (Exception $e) {
            throw new Exception("Error resetting user password. | Database error.", 400);
        }
    }
}
