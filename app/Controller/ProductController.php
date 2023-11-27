<?php

namespace app\Controller;

include "app/Traits/ApiResponseFormatter.php";
include "app/Models/Product.php";

use app\Models\Product;
use app\Traits\ApiResponseFormatter;

class ProductController{
    // Pakai Trait yg sudah dibuat
    use ApiResponseFormatter;

    public function index(){
        //Definisikan object model product yang sudah dibuat
        $productModel = new Product();
        //Panggil fungsi GetAll Product
        $response = $productModel->findAll();
        //Return $response dengan melakukan formatting terlebih dahulu menggunakan trait yang sudah dipanggil
        return $this->apiResponse(200, "Success", $response);

    }


    public function getById($id){
        $productModel = new Product();
        $response = $productModel->findById($id);
        return $this->apiResponse(200, "Success", $response);
    }


    public function insert(){
        //Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        //Validasi apakah inputan valid
        if (json_last_error()){
            return $this->apiResponse(400, "Error invalid input", null);
        }

        //Lanjut jika tidak error
        $productModel = new Product();
        $response = $productModel->create([
            "product_name" => $inputData['product_name']
        ]);
        
        return $this->apiResponse(200, "Success", $response);
    }


    public function update($id){
        //Tangkap input JSON
        $jsonInput = file_get_contents('php://input');
        $inputData = json_decode($jsonInput, true);
        //Validasi apakah inputan valid
        if (json_last_error()){
            return $this->apiResponse(400, "Error invalid input", null);
        }

        //Lanjut jika tidak error
        $productModel = new Product();
        $response = $productModel->update([
            "product_name" => $inputData['product_name']
        ], $id);
        
        return $this->apiResponse(200, "Success", $response);
    }


    public function delete($id){
        $productModel = new Product();
        $response = $productModel->destroy($id);
        
        return $this->apiResponse(200, "Success", $response);
    }
}