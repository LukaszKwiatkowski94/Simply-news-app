<?php

declare(strict_types=1);

namespace APP;

use APP\Classes\UserData;

/**
 * Manages user session data.
 */
final class User
{
    /**
     * Logs in a user by storing their data in the session.
     * @param UserData $userData The user data to store in the session.
     * @return void
     */
    public static function login(UserData $userData): void
    {
        $_SESSION['user'] = [
            'id' => $userData->id,
            'username' => $userData->username,
            'name' => $userData->name,
            'surname' => $userData->surname,
        ];
    }

    /**
     * Logs out the current user by clearing their session data.
     * @return void
     */
    public static function logout(): void
    {
        unset($_SESSION['user']);
    }

    public static function isLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getUserInfo(): UserData
    {
        return new UserData(
            $_SESSION['user']['id'] ?? null,
            $_SESSION['user']['username'] ?? null,
            $_SESSION['user']['name'] ?? null,
            $_SESSION['user']['surname'] ?? null
        );
    }

    public static function getUserId(): ?int
    {
        return $_SESSION['user']['id'] ?? null;
    }

    public static function getUsername(): ?string
    {
        return $_SESSION['user']['username'] ?? null;
    }

    public static function getName(): ?string
    {
        return $_SESSION['user']['name'] ?? null;
    }

    public static function getSurname(): ?string
    {
        return $_SESSION['user']['surname'] ?? null;
    }

    public static function isAdmin(): bool
    {
        //TODO:  implement admin check logic
        return true;
    }
}
