<?php

namespace app\Routes;

include "app/Controller/ProductController.php";

use app\Controller\ProductController;

class ProductRoutes{
    public function handle($method, $path){
        // Jika request method GET dan path sama dengan '/api/product'
        if ($method == 'GET' && $path == '/api/product'){
            $controller = new ProductController();
            echo $controller->index();
        }

        // Jika request method GET dan path mengandung '/api/product'
        if ($method == 'GET' && strpos($path, '/api/product') == 0){
            //Extra ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new ProductController();
            echo $controller->getById($id);
        }

        // Jika request method POST dan path sama dengan '/api/product'
        if ($method == 'POST' && $path == '/api/product'){
            $controller = new ProductController();
            echo $controller->insert();
        }

        // Jika request method PUT dan path mengandung '/api/product'
        if ($method == 'PUT' && strpos($path, '/api/product') == 0){
            //Extra ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new ProductController();
            echo $controller->update($id);
        }

        // Jika request method DELETE dan path mengandung '/api/product'
        if ($method == 'DELETE' && strpos($path, '/api/product') == 0){
            //Extra ID dari path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 1];

            $controller = new ProductController();
            echo $controller->delete($id);
        }

        // Jika request method GET dan path sama dengan '/api/products-with-categories'
        if ($method == 'GET' && $path == '/api/products-with-categories') {
            $controller = new ProductController();
            echo $controller->indexWithCategory();
        }
        
        // Jika request method GET dan path = '/api//{category_id}'
        if ($method == 'GET' && strpos($path, '/api/products-by-category') == 0) {
            // Extract category_id from the path
            $pathParts = explode('/', $path);
            $category_id = $pathParts[count($pathParts) - 1];

            $controller = new ProductController();
            echo $controller->findByCategoryId($category_id);
        }

        // jika request method PUT dan the path = '/api/add-category-to-product'
        if ($method == 'PUT' && strpos($path, '/api/add-category-to-product') == 0) {
            // Extract id and category_id from the path
            $pathParts = explode('/', $path);
            $id = $pathParts[count($pathParts) - 2];
            $category_id = $pathParts[count($pathParts) - 1];

            $controller = new ProductController();
            echo $controller->addCategory($id, $category_id);
        }
    }


}