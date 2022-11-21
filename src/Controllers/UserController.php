<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Models\UserModel;

class UserController extends AbstractController
{
    private UserModel $model;

    public function __construct($request)
    {
        $this->model = new UserModel();
        parent::__construct($request);
    }

    public function logIn(): void
    {
        if(!empty($this->request->getRequestPost()))
        {
            $data = $this->request->getRequestPost();
            $user = $this->model->get($data);
            
            if(!empty($user))
            {
                $_SESSION['user'] = $user;
                self::$response->redirect('/')->send();
            }
            else
            {

            }
        }
        $params['header'] = 'Log In';
        $this->view->render('login',$params);
    }

    public function logOut(): void
    {
        session_destroy();
        self::$response->redirect('/')->send();
    }

    public function signUp(): void
    {
        if(!empty($this->request->getRequestPost()))
        {
            $data = $this->request->getRequestPost();
            var_dump($data);
            $userValidationStatus = $this->model->create($data);
            if($userValidationStatus)
            {
                self::$response->redirect('/login')->send();
            }
            else
            {

            }
        }

        $params['header'] = 'Sign Up';
        $this->view->render('signup',$params);
    }
}