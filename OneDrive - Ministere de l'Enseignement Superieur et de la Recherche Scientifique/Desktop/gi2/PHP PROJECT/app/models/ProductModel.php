<?php
require_once "config/database.php";

class ProductModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllProducts() {
        try {
            // Log table structure
            $stmt = $this->pdo->prepare("DESCRIBE products");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            error_log("Products Table Structure: " . json_encode($columns));

            // Fetch all products with detailed logging
            $stmt = $this->pdo->prepare("SELECT * FROM products");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Detailed logging
            error_log("Total Products: " . count($products));
            foreach ($products as $product) {
                error_log("Product Details: " . json_encode($product));
            }
            
            return $products;
        } catch (PDOException $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
    }
}
?>
