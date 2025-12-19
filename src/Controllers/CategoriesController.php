<?php

declare(strict_types=1);

namespace APP\Controllers;

use APP\Controllers\AbstractController;
use APP\Models\CategoriesModel;
use Exception;

final class CategoriesController extends AbstractController
{
    public function list(): void
    {
        try {
            $categoriesModel = new CategoriesModel();
            $categories = $categoriesModel->list();

            $params['header'] = 'Categories';
            $params['categories'] = $categories;

            $this->view->render('categories/list', $params);
        } catch (Exception $e) {
            throw new Exception("Unable to fetch categories", 500);
        }
    }

    public function create(): void
    {
        try {
            $data = self::$request->getRequestPost();
            $categoriesModel = new CategoriesModel();
            $categoriesModel->create($data['name']);

            self::$response->redirect('/categories');
        } catch (Exception $e) {
            throw new Exception("Error creating category", 400);
        }
    }
}
