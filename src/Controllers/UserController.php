<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Classes\UserData;
use APP\Controllers\AbstractController;
use APP\Models\UserModel;
use Exception;

/**
 * Class UserController
 *
 * @package APP\Controllers
 */
final class UserController extends AbstractController
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
                throw new Exception("Error while logging in. Check the correctness of the data and log in again.", 400);
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
                throw new Exception("User registration error.", 400);
            }
        } else if (!self::$user->isLoggedIn()) {
            $params['header'] = 'Sign Up';
            $this->view->render('signup', $params);
        } else {
            self::$response->redirect('/');
        }
    }

    /**
     * User account profile page
     */
    public function account(): void
    {
        if (!self::$user->isLoggedIn()) {
            self::$response->redirect('/login');
            return;
        }

        $params['header'] = 'My Account';
        $params['page'] = 'user/account';
        $params['user'] = self::$user->getUserInfo();

        $this->view->render('base', $params);
    }

    /**
     * Change user password
     */
    public function changePassword(): void
    {
        if (!self::$user->isLoggedIn()) {
            self::$response->redirect('/login');
            return;
        }

        if (!empty($this->request->getRequestPost())) {
            $data = $this->request->getRequestPost();

            if (empty($data['oldPassword']) || empty($data['newPassword']) || empty($data['confirmPassword'])) {
                throw new Exception("All fields are required.", 400);
            }

            if ($data['newPassword'] !== $data['confirmPassword']) {
                throw new Exception("New passwords do not match.", 400);
            }

            if (strlen($data['newPassword']) < 6) {
                throw new Exception("Password must be at least 6 characters long.", 400);
            }

            try {
                $userId = self::$user->getUserId();
                $this->model->changePassword($userId, $data['oldPassword'], $data['newPassword']);
                self::$response->redirect('/account?success=password_changed');
            } catch (Exception $e) {
                throw new Exception($e->getMessage(), 400);
            }
        } else {
            $params['header'] = 'Change Password';
            $params['page'] = 'user/change-password';

            $this->view->render('base', $params);
        }
    }
}
