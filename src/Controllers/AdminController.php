<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Models\AdminUsersModel;
use APP\Models\AdminNewsModel;
use APP\Models\AdminCategoriesModel;
use Exception;

final class AdminController extends AbstractController
{
    private AdminUsersModel $usersModel;
    private AdminNewsModel $newsModel;
    private AdminCategoriesModel $categoriesModel;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->usersModel = new AdminUsersModel();
        $this->newsModel = new AdminNewsModel();
        $this->categoriesModel = new AdminCategoriesModel();

        // Middleware: Check if user is admin
        if (!self::$user->isLoggedIn() || !self::$user->isAdmin()) {
            throw new Exception("Access denied. Admin privileges required.", 403);
        }
    }

    /**
     * Admin Dashboard
     */
    public function dashboard(): void
    {
        try {
            $params['header'] = 'Admin Dashboard';
            $params['page'] = 'admin/dashboard';

            // Add statistics
            $params['articlesCount'] = $this->newsModel->countArticles();
            $params['usersCount'] = count($this->usersModel->getAllUsers());
            $params['categoriesCount'] = $this->categoriesModel->countCategories();

            $this->view->render('base', $params);
        } catch (Exception $e) {
            throw new Exception("Error loading admin dashboard.", 500);
        }
    }

    /**
     * Admin Articles Management
     */
    public function articles(): void
    {
        try {
            $params['header'] = 'Manage Articles';
            $params['page'] = 'admin/articles/list';
            $params['articles'] = $this->newsModel->getAllNews();

            $this->view->render('base', $params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode() ?: 500);
        }
    }

    /**
     * Toggle article status
     */
    public function toggleArticleStatus(int $id): void
    {
        try {
            if (empty($this->request->getRequestPost())) {
                throw new Exception("Invalid request method.", 400);
            }

            $this->newsModel->toggleArticleStatus($id);
            self::$response->redirect('/admin/articles');
        } catch (Exception $e) {
            throw new Exception("Error updating article status.", 500);
        }
    }

    /**
     * Delete article
     */
    public function deleteArticle(int $id): void
    {
        try {
            if (empty($this->request->getRequestPost())) {
                throw new Exception("Invalid request method.", 400);
            }

            $this->newsModel->deleteArticle($id);
            self::$response->redirect('/admin/articles');
        } catch (Exception $e) {
            throw new Exception("Error deleting article.", 500);
        }
    }

    /**
     * Admin Categories Management
     */
    public function categories(): void
    {
        try {
            $params['header'] = 'Manage Categories';
            $params['page'] = 'admin/categories/list';
            $params['categories'] = $this->categoriesModel->getAllCategories();

            $this->view->render('base', $params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode() ?: 500);
        }
    }

    /**
     * Create category
     */
    public function createCategory(): void
    {
        try {
            if (!empty($this->request->getRequestPost())) {
                $data = $this->request->getRequestPost();

                if (empty($data['name'])) {
                    throw new Exception("Category name is required.", 400);
                }

                $this->categoriesModel->createCategory($data['name']);
                self::$response->redirect('/admin/categories');
            } else {
                $params['header'] = 'Create Category';
                $params['page'] = 'admin/categories/create';
                $this->view->render('base', $params);
            }
        } catch (Exception $e) {
            throw new Exception("Error creating category.", 500);
        }
    }

    /**
     * Edit category
     */
    public function editCategory(int $id): void
    {
        try {
            if (!empty($this->request->getRequestPost())) {
                $data = $this->request->getRequestPost();

                if (empty($data['name'])) {
                    throw new Exception("Category name is required.", 400);
                }

                $this->categoriesModel->updateCategory($id, $data['name']);
                self::$response->redirect('/admin/categories');
            } else {
                $params['header'] = 'Edit Category';
                $params['page'] = 'admin/categories/edit';
                $params['category'] = $this->categoriesModel->getCategoryById($id);

                if (empty($params['category'])) {
                    throw new Exception("Category not found.", 404);
                }

                $this->view->render('base', $params);
            }
        } catch (Exception $e) {
            throw new Exception("Error editing category.", 500);
        }
    }

    /**
     * Delete category
     */
    public function deleteCategory(int $id): void
    {
        try {
            if (empty($this->request->getRequestPost())) {
                throw new Exception("Invalid request method.", 400);
            }

            $this->categoriesModel->deleteCategory($id);
            self::$response->redirect('/admin/categories');
        } catch (Exception $e) {
            throw new Exception("Error deleting category.", 500);
        }
    }

    /**
     * Admin Users Management
     */
    public function users(): void
    {
        try {
            $params['header'] = 'Manage Users';
            $params['page'] = 'admin/users/list';
            $params['users'] = $this->usersModel->getAllUsers();

            $this->view->render('base', $params);
        } catch (Exception $e) {
            throw new Exception("Error loading users management.", 500);
        }
    }

    /**
     * Toggle user admin role
     */
    public function toggleUserRole(int $userId): void
    {
        try {
            if (empty($this->request->getRequestPost())) {
                throw new Exception("Invalid request method.", 400);
            }

            $this->usersModel->toggleAdminRole($userId);
            self::$response->redirect('/admin/users');
        } catch (Exception $e) {
            throw new Exception("Error updating user role.", 500);
        }
    }

    /**
     * Toggle user active status (block/unblock)
     */
    public function toggleUserStatus(int $userId): void
    {
        try {
            if (empty($this->request->getRequestPost())) {
                throw new Exception("Invalid request method.", 400);
            }

            $this->usersModel->toggleUserStatus($userId);
            self::$response->redirect('/admin/users');
        } catch (Exception $e) {
            throw new Exception("Error updating user status.", 500);
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(int $userId): void
    {
        try {
            if (empty($this->request->getRequestPost())) {
                throw new Exception("Invalid request method.", 400);
            }

            // Prevent deleting yourself
            if ($userId === self::$user->getUserId()) {
                throw new Exception("You cannot delete your own account.", 400);
            }

            $this->usersModel->deleteUser($userId);
            self::$response->redirect('/admin/users');
        } catch (Exception $e) {
            throw new Exception("Error deleting user.", 500);
        }
    }
}
