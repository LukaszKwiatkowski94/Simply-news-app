<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Models\AbstractModel;

class UserModel extends AbstractModel{

    public function create(array $data): void
    {
        $username = $this->connection->quote($data['userdata']);
        $password = $this->connection->quote($data['password']);
        $query = "INSERT into users(username,password) VALUES($username,$password)";
        $result = $this->connection->exec($query);
    }

    public function get(array $data): void
    {

    }

    public function check(array $data): void
    {

    }
}