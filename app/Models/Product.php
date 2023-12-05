<?php

namespace app\Models;

include "app/Config/DatabaseConfig.php";

use app\Config\DatabaseConfig;
use mysqli;

class Product extends DatabaseConfig{

    public $conn;

    public function __construct(){
        // Connect ke database my sql
        $this->conn = new mysqli($this-> host, $this-> user, $this-> password, $this-> database_name, $this-> port);
        // Check connection
        if($this->conn->connect_error){
            die("Connection Failed : " . $this->conn->connect_error);
        }
    }

    // Proses Menampilkan Semua Data
    public function findAll(){
        $sql = "SELECT * from products";
        $result = $this->conn->query($sql);
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        return $data;    
    }

    // Proses Menampilkan data by id
    public function findById($id){
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;     
        }
        return $data;
    }

    // Proses Insert data
    public function create($data){
        $productName = $data['product_name'];
        $query = "INSERT INTO products (product_name) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $productName);
        $stmt->execute();
        $this->conn->close();
    }

    // Proses Update data by id
    public function update($data, $id){
        $productName = $data['product_name'];
        $query = "UPDATE products SET product_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        //huruf "s" berart tipe parameter product_name adalah String sedangkan jika huruf "i" adalah integer
        $stmt->bind_param("si", $productName, $id);
        $stmt->execute();
        $this->conn->close();
    }

    // Proses Delete data dengan id
    public function destroy($id){
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        // huruf "i" maka parameternya adalah intger
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $this->conn->close();
    } 

    // Mendapatkan semua data ditambahkan nama kategori
    public function findAllWithCategory()
    {
        $sql = "SELECT products.*, categories.category_name
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id";
        $result = $this->conn->query($sql);
        $this->conn->close();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // Mendapatkan data sesuai id kategori
    public function findByCategoryId($category_id)
    {
        $sql = "SELECT products.product_name, products.category_id, categories.category_name
                FROM products
                LEFT JOIN categories ON products.category_id = categories.id
                WHERE products.category_id = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->conn->close();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    //  Menambahkan category_id di sebuah product by ID
    public function addCategoryId($id, $category_id)
    {
        $query = "UPDATE products SET category_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $category_id, $id);
        $stmt->execute();
        $this->conn->close();
    }
}