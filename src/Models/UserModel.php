<?php

declare(strict_types=1);

namespace APP\Models;

use APP\Controllers\ErrorController;
use APP\Exception\UserException;
use APP\Models\AbstractModel;
use Exception;
use PDO;

class UserModel extends AbstractModel{

    public function create(array $data)
    {
        try
        {
            $username = $this->connection->quote($data['username']);
            $password = $this->connection->quote($data['password']);
            $name = $this->connection->quote($data['name']);
            $surname = $this->connection->quote($data['surname']);
            if($username = '' || $password = '' || $name = '' || $surname = '')
            {
                throw new UserException("Incomplete user creation data. | Database error.",400);
            }
            $query = "INSERT into users(username,password,name,surname) VALUES($username,$password,$name,$surname)";
            $result = $this->connection->exec($query);
            return $result;
        }
        catch(Exception)
        {
            throw new UserException("User creation error. | Database error.",400);
        }
    }

    public function get(array $data)
    {
        try
        {
            $username = $this->connection->quote($data['username']);
            $password = $this->connection->quote($data['password']);
            $query = "SELECT * 
                    FROM users 
                    WHERE username = $username AND password = $password";
            $user = $this->connection->query($query);
            return $user->fetch(PDO::FETCH_ASSOC) ?? [];
        }
        catch(Exception)
        {
            throw new UserException("Error while logging in. Check the correctness of the data and log in again. | DataBase Error",400);
        }
    }
}