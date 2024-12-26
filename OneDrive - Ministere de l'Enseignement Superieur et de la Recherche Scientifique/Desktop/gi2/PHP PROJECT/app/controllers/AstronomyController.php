<?php
require_once 'app/models/ProductModel.php';
require_once 'app/models/BlogModel.php';

class AstronomyController {
    private $productModel;
    private $blogModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->blogModel = new BlogModel();
    }

    public function showAstronomyPage() {
        $products = $this->productModel->getAllProducts();
        $approvedBlogs = $this->blogModel->getApprovedBlogs();
        include 'app/views/astro.php';
    }
}
?>
