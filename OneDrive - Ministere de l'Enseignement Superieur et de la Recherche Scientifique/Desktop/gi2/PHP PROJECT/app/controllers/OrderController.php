<?php
require_once 'app/models/OrderModel.php';
require_once 'app/models/CartModel.php';

class OrderController {
    private $orderModel;
    private $cartModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
        $this->cartModel = new CartModel();
    }

    public function placeOrder() {
        // Check for user session using both possible keys
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) {
            error_log("No user session found during place order");
            header('Location: index.php?page=login&error=Please login first');
            exit();
        }

        // Use the appropriate user ID
        $userId = $_SESSION['user_id'] ?? $_SESSION['user']['id'];

        $cartTotal = $this->cartModel->calculateCartTotal($userId);

        if ($cartTotal <= 0) {
            header('Location: index.php?page=cart&error=Your cart is empty');
            exit();
        }

        require 'app/views/placeOrder.php';
    }

    public function confirmOrder() {
        // Check for user session using both possible keys
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) {
            error_log("No user session found during order confirmation");
            header('Location: index.php?page=login&error=Please login first');
            exit();
        }

        // Use the appropriate user ID
        $userId = $_SESSION['user_id'] ?? $_SESSION['user']['id'];
        $cartTotal = $this->cartModel->calculateCartTotal($userId);

        // Validate input
        $name = $_POST['name'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $location = $_POST['location'] ?? '';

        if (empty($name) || empty($lastname) || empty($phone) || empty($location)) {
            header('Location: index.php?page=placeOrder&error=All fields are required');
            exit();
        }

        $orderId = $this->orderModel->createOrder(
            $userId, 
            $cartTotal, 
            $name, 
            $lastname, 
            $phone, 
            $location
        );

        if ($orderId === false) {
            // Log additional context
            error_log("Order creation failed for user $userId with total $cartTotal");
            
            // Pass more descriptive error message
            header("Location: index.php?page=placeOrder&error=Order creation failed. Please check your cart and try again.");
            exit();
        } else {
            header("Location: index.php?page=details&orderId={$orderId}");
        }
        exit();
    }

    public function viewOrderDetails($orderId) {
        // Check for user session using both possible keys
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) {
            error_log("No user session found during order details view");
            header('Location: index.php?page=login&error=Please login first');
            exit();
        }

        $orderDetails = $this->orderModel->getOrderDetails($orderId);

        if (empty($orderDetails)) {
            header('Location: index.php?page=products&error=Order not found');
            exit();
        }

        require 'app/views/details.php';
    }

    public function listAdminOrders() {
        // Check for user session using both possible keys
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            error_log("Unauthorized access attempt to admin orders");
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        $orders = $this->orderModel->getAllOrders();
        require 'app/views/admin/orders.php';
    }

    public function markOrderShipped($orderId) {
        // Check if user is an admin
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            error_log("Unauthorized access attempt to admin orders");
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        // Attempt to update order status
        $result = $this->orderModel->updateOrderStatus($orderId, 'shipped');

        if ($result) {
            // Redirect with success message
            header('Location: index.php?page=admin/orders&success=Order ' . $orderId . ' marked as shipped');
            exit();
        } else {
            // Redirect with error message
            header('Location: index.php?page=admin/orders&error=Failed to mark order as shipped');
            exit();
        }
    }
}
