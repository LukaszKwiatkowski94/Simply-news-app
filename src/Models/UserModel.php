<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;
use PDO;

class UserModel extends AbstractModel{

    public function create(array $data)
    {
        $username = $this->connection->quote($data['username']);
        $password = $this->connection->quote($data['password']);
        $name = $this->connection->quote($data['name']);
        $surname = $this->connection->quote($data['surname']);
        $query = "INSERT into users(username,password,name,surname) VALUES($username,$password,$name,$surname)";
        $result = $this->connection->exec($query);
        return $result;
    }

    public function get(array $data): array
    {   
        $username = $this->connection->quote($data['username']);
        $password = $this->connection->quote($data['password']);
        $query = "SELECT * 
                FROM users 
                WHERE username = $username AND password = $password";
        $user = $this->connection->query($query);
        return $user->fetch(PDO::FETCH_ASSOC) ?? [];
    }
}