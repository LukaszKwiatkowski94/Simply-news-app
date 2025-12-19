<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Classes\UserData;
use APP\Controllers\AbstractController;
use APP\Exception\UserException;
use APP\Models\UserModel;
use APP\User;

class UserController extends AbstractController
{
    private UserModel $model;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->model = new UserModel();
    }

    public function logIn(): void
    {
        if (!empty($this->request->getRequestPost()) && !self::$user->isLoggedIn()) {
            $data = $this->request->getRequestPost();
            $user = $this->model->get($data);

            if (!empty($user)) {
                $userData = new UserData(
                    (int)$user['id'],
                    $user['username'],
                    $user['name'],
                    $user['surname']
                );
                self::$user->login($userData);
                self::$response->redirect('/');
            } else {
                throw new UserException("Error while logging in. Check the correctness of the data and log in again.", 400);
            }
        } else if (self::$user->isLoggedIn()) {
            self::$response->redirect('/');
        } else {
            $params['header'] = 'Log In';
            $this->view->render('login', $params);
        }
    }

    public function logOut(): void
    {
        if (self::$user->isLoggedIn()) {
            self::$user->logout();
        }
        self::$response->redirect('/');
    }

    public function signUp(): void
    {
        if (!empty($this->request->getRequestPost()) && !self::$user->isLoggedIn()) {
            $data = $this->request->getRequestPost();
            $userValidationStatus = $this->model->create($data);
            if ($userValidationStatus) {
                self::$response->redirect('/login');
            } else {
                throw new UserException("User registration error.", 400);
            }
        } else if (!self::$user->isLoggedIn()) {
            $params['header'] = 'Sign Up';
            $this->view->render('signup', $params);
        } else {
            self::$response->redirect('/');
        }
    }
}
