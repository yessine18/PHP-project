<?php
require_once "config/database.php";
require_once 'app/models/ProductModel.php';


class UserController {

    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }

    public function solarSystem() {
        include 'app/views/solar_system.php';
    }

    public function logout()
    {
        // Destroy the session
        session_start();
        session_unset();
        session_destroy();

        // Redirect to login page
        header("Location: index.php?page=login");
        exit();
    }
    public function explore() {
        include 'app/views/explore.php';
    }
    
    public function astronomy() {
        $products = $this->productModel->getAllProducts();
        include 'app/views/astronomy.php';
    }
}