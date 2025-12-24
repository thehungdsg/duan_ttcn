<a
  href="index.php?controller=auth&action=logout"
  class="text-text-secondary hover:text-primary-dark transition-colors text-sm font-medium leading-normal"
>
    Đăng xuất
</a>


<?php
include "../../Assets/css/client/header.php";
 include "../../Assets/css/client/navbar.php";

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