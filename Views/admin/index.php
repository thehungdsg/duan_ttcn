<?php
ob_start(); // 🚨 BẮT BUFFER

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header('Location: index.php?controller=auth&action=loginForm');
    exit;
}

require "../../Assets/css/admin/headerAdmin.php";
include('product_start.php');
include('product_actions.php');
// include('product_table.php');

include '../../config.php';
include '../../Controllers/product_controller.php';


$controller = $_GET['controller'] ?? 'product';
$action = $_GET['action'] ?? 'index';

$productController = new ProductController($conn);

if (method_exists($productController, $action)) {
    $productController->$action();
} else {
    echo "Action không tồn tại";
}

?>
