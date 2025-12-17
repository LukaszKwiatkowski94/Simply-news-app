<?php

declare(strict_types=1);

class User
{
    public static function login(array $userData): void
    {
        $_SESSION['user'] = [
            'id' => $userData['id'],
            'username' => $userData['username'],
            'name' => $userData['name'],
            'surname' => $userData['surname'],
        ];
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
    }
}
