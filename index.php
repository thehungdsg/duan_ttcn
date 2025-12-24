<?php
session_start();
require_once 'config.php';

require_once 'Controllers/cart_controller.php';
require_once 'Controllers/product_controller.php';

$controller = $_GET['controller'] ?? 'product';
$action     = $_GET['action'] ?? 'index';

switch ($controller) {

    case 'auth':
        require_once 'Controllers/auth_controller.php';
        $c = new AuthController($conn);
        break;

    case 'admin':
        // 🔐 BẮT BUỘC ĐĂNG NHẬP + ROLE ADMIN
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            header('Location: index.php?controller=auth&action=loginForm');
            exit;
        }
        // ❗ KHÔNG require admin_controller nữa
        require_once 'Controllers/product_controller.php';
        $c = new ProductController($conn);
        break;
    case 'order':
        require_once 'Controllers/order_controller.php';
        $c = new OrderController($conn);
        break;
    
    case 'cart':
        require_once 'Controllers/cart_controller.php';

        $c = new CartController();
        break;

    case 'product':
    default:
        require_once 'Controllers/product_controller.php';
        $c = new ProductController($conn);
        break;
}

if (method_exists($c, $action)) {
    $c->$action();
} else {
    echo "404 - Action không tồn tại";
}
