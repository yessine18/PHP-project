<?php
require_once 'app/models/CartModel.php';

class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }

    public function addToCart($productId = null) {        
        // Check if user is logged in
        if (!isset($_SESSION['user']['id'])) {
            error_log("Add to Cart Failed: User not logged in");
            header('Location: index.php?page=login&error=Please login first');
            exit();
        }

        // If no productId passed, try to get from GET or POST
        if ($productId === null) {
            $productId = $_GET['productId'] ?? $_POST['productId'] ?? null;
        }

        // Log all incoming data for debugging
        error_log("Add to Cart Request: " . 
            "ProductID = " . print_r($productId, true) . 
            ", GET = " . print_r($_GET, true) . 
            ", POST = " . print_r($_POST, true)
        );

        // Validate product ID
        $productId = filter_var($productId, FILTER_VALIDATE_INT);
        if ($productId === false || $productId === null) {
            error_log("Invalid product ID: " . ($productId ?? 'null'));
            header('Location: index.php?page=astronomy&error=Invalid product');
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $quantity = 1; // Default to 1 since quantity input was removed

        try {
            $result = $this->cartModel->addToCart($userId, $productId, $quantity);
            
            if ($result) {
                error_log("Product added to cart successfully: UserID = $userId, ProductID = $productId");
                header('Location: index.php?page=astronomy&success=Product added to cart');
            } else {
                error_log("Failed to add product to cart: UserID = $userId, ProductID = $productId");
                header('Location: index.php?page=astronomy&error=Product out of stock or cannot be added to cart');
            }
        } catch (Exception $e) {
            error_log("Exception in addToCart: " . $e->getMessage());
            header('Location: index.php?page=astronomy&error=An error occurred while adding product to cart');
        }
        exit();
    }

    public function viewCart() {
        
        $userId = $_SESSION['user']['id'];
        $cartItems = $this->cartModel->getCartItems($userId);
        $cartTotal = $this->cartModel->calculateCartTotal($userId);

        require 'app/views/cart.php';
    }

    public function removeFromCart() {
        // Log the incoming data for debugging
        error_log("Remove from Cart - POST Data: " . print_r($_POST, true));
        error_log("Remove from Cart - GET Data: " . print_r($_GET, true));

        // Validate cart ID from POST or GET
        $cartId = $_POST['cartId'] ?? $_GET['cartId'] ?? null;

        // Ensure user is logged in
        if (!isset($_SESSION['user']['id'])) {
            error_log("Remove from Cart Failed: User not logged in");
            header('Location: index.php?page=login&error=Please login first');
            exit();
        }

        // Validate cart ID
        if (!$cartId || !is_numeric($cartId)) {
            error_log("Invalid cart ID provided for removal: " . print_r($cartId, true));
            header('Location: index.php?page=cart&error=Invalid cart item');
            exit();
        }

        $userId = $_SESSION['user']['id'];
        
        try {
            // Attempt to remove the cart item
            $result = $this->cartModel->removeCartItem($cartId, $userId);

            if ($result) {
                error_log("Cart item removed successfully: CartID=$cartId, UserID=$userId");
                header('Location: index.php?page=cart&success=Item removed from cart');
            } else {
                error_log("Failed to remove cart item: CartID=$cartId, UserID=$userId");
                header('Location: index.php?page=cart&error=Failed to remove item');
            }
        } catch (Exception $e) {
            error_log("Exception in removeFromCart: " . $e->getMessage());
            header('Location: index.php?page=cart&error=An error occurred');
        }
        exit();
    }
}
