<?php

use APP\Controllers\CommentsController;
use APP\Controllers\NewsController;
use APP\Controllers\UserController;
use APP\HttpMethod;

return function ($router) {
    // News routes
    $router->add(HttpMethod::GET, '/', NewsController::class, 'mainPage');
    $router->add(HttpMethod::GET, '/news-show/{id}', NewsController::class, 'show');
    $router->add(HttpMethod::GET, '/news-create', NewsController::class, 'create');
    $router->add(HttpMethod::POST, '/news-create', NewsController::class, 'create');
    $router->add(HttpMethod::GET, '/news-list', NewsController::class, 'list');
    $router->add(HttpMethod::GET, '/news-delete/{id}', NewsController::class, 'delete');
    $router->add(HttpMethod::GET, '/news-edit/{id}', NewsController::class, 'edit');
    $router->add(HttpMethod::POST, '/news-edit/{id}', NewsController::class, 'edit');

    // User routes
    $router->add(HttpMethod::GET, '/login', UserController::class, 'logIn');
    $router->add(HttpMethod::POST, '/login', UserController::class, 'logIn');
    $router->add(HttpMethod::GET, '/signup', UserController::class, 'signUp');
    $router->add(HttpMethod::POST, '/signup', UserController::class, 'signUp');
    $router->add(HttpMethod::GET, '/logout', UserController::class, 'logOut');

    // Comments routes
    $router->add(HttpMethod::GET, '/comments-news/{id}', CommentsController::class, 'getComments');
    $router->add(HttpMethod::POST, '/comments-create', CommentsController::class, 'createComment');

    // Categories routes
    $router->add(HttpMethod::GET, '/categories', NewsController::class, 'list');
    $router->add(HttpMethod::POST, '/categories-create', NewsController::class, 'create');
};
