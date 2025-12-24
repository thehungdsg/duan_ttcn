<?php

class CartController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = $_SESSION['cart'];
        include __DIR__ . '/../Views/client/view_cart.php';
    }

    // Thêm sản phẩm vào giỏ
    public function add()
    {
       
        
        if (!isset($_GET['product_id'])) {
            header("Location: index.php");
            exit;
        }

        $product_id = (int) $_GET['product_id'];
       

        require_once __DIR__ . '/../Models/product_model.php';
        $productModel = new ProductModel($GLOBALS['conn']);
        $product = $productModel->findByProductId($product_id);

        if (!$product) {
            header("Location: index.php?controller=cart&action=index");
            exit;
        }

        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'product_id'   => $product['product_id'],
                'product_name' => $product['product_name'],
                'price'        => $product['price'],
                'image'        => $product['image'],
                'quantity'     => 1
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity']++;
        }

        // ✅ quay về trang trước (an toàn)

        header("Location: index.php?controller=cart&action=index");
exit;

    }

    // Cập nhật số lượng
    public function update()
    {
        if (!isset($_POST['qty'])) {
            header("Location: index.php?controller=cart&action=index");
            exit;
        }

        foreach ($_POST['qty'] as $id => $qty) {
            $id = (int) $id;
            $qty = (int) $qty;

            if ($qty <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id]['quantity'] = $qty;
            }
        }

        header("Location: index.php?controller=cart&action=index");
        exit;
    }

    // Xóa 1 sản phẩm
    public function remove()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            unset($_SESSION['cart'][$id]);
        }

        header("Location: index.php?controller=cart&action=index");
        exit;
    }
}
