<?php

use APP\Controllers\AdminController;
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
    $router->add(HttpMethod::GET, '/account', UserController::class, 'account');
    $router->add(HttpMethod::GET, '/account/change-password', UserController::class, 'changePassword');
    $router->add(HttpMethod::POST, '/account/change-password', UserController::class, 'changePassword');

    // Admin routes
    $router->add(HttpMethod::GET, '/admin', AdminController::class, 'dashboard');
    $router->add(HttpMethod::GET, '/admin/articles', AdminController::class, 'articles');
    $router->add(HttpMethod::POST, '/admin/articles/{id}/toggle-status', AdminController::class, 'toggleArticleStatus');
    $router->add(HttpMethod::POST, '/admin/articles/{id}/delete', AdminController::class, 'deleteArticle');
    $router->add(HttpMethod::GET, '/admin/categories', AdminController::class, 'categories');
    $router->add(HttpMethod::GET, '/admin/categories/create', AdminController::class, 'createCategory');
    $router->add(HttpMethod::POST, '/admin/categories/create', AdminController::class, 'createCategory');
    $router->add(HttpMethod::GET, '/admin/categories/{id}/edit', AdminController::class, 'editCategory');
    $router->add(HttpMethod::POST, '/admin/categories/{id}/edit', AdminController::class, 'editCategory');
    $router->add(HttpMethod::POST, '/admin/categories/{id}/delete', AdminController::class, 'deleteCategory');
    $router->add(HttpMethod::GET, '/admin/users', AdminController::class, 'users');
    $router->add(HttpMethod::POST, '/admin/users/{id}/toggle-role', AdminController::class, 'toggleUserRole');
    $router->add(HttpMethod::POST, '/admin/users/{id}/toggle-status', AdminController::class, 'toggleUserStatus');
    $router->add(HttpMethod::POST, '/admin/users/{id}/delete', AdminController::class, 'deleteUser');

    // Comments routes
    $router->add(HttpMethod::GET, '/comments-news/{id}', CommentsController::class, 'getComments');
    $router->add(HttpMethod::POST, '/comments-create', CommentsController::class, 'createComment');

    // Categories routes
    $router->add(HttpMethod::GET, '/categories', NewsController::class, 'list');
    $router->add(HttpMethod::POST, '/categories-create', NewsController::class, 'create');
};
