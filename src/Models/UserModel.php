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
            if($data['username'] == '' || $data['password'] == '' || $data['name'] == '' || $data['surname'] == '')
            {
                throw new UserException("Incomplete user creation data. | Database error.",400);
            }
            $username = $this->connection->quote($data['username']);
            $password = $this->connection->quote(password_hash($data['password'],PASSWORD_DEFAULT));
            $name = $this->connection->quote($data['name']);
            $surname = $this->connection->quote($data['surname']);
            $query = "INSERT into users(username,password,name,surname) VALUES($username,$password,$name,$surname)";
            $result = $this->connection->exec($query);
            return $result;
        }
        catch(Exception $e)
        {
            throw new UserException("User creation error. | Database error.",400);
        }
    }

    public function get(array $data)
    {
        try
        {
            $username = $this->connection->quote($data['username']);
            $password = $data['password'];
            $query = "SELECT * 
                    FROM users 
                    WHERE username = $username";
            $user = $this->connection->query($query);
            $getUser = $user->fetch(PDO::FETCH_ASSOC) ?? [];
            if (isset($getUser))
            {
                if (password_verify($password, $getUser['password']))
                {
                    return $getUser;
                }
                else
                {
                    return [];
                }
            }
            else
            {
                return [];
            } 
        }
        catch(Exception $e)
        {
            throw new UserException("Error while logging in. Check the correctness of the data and log in again. | DataBase Error",400);
        }
    }
}