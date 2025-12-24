<?php
require_once __DIR__ . '/../Models/order_model.php';

class OrderController
{
    private OrderModel $orderModel;

    public function __construct(PDO $conn)
    {
        $this->orderModel = new OrderModel($conn);
    }

    public function index()
    {
        $orders = $this->orderModel->getAll();
        include __DIR__ . '/../Views/admin/order.php';
    }
    public function view()
    {
        // Code để hiển thị chi tiết đơn hàng
    }
    public function updateStatus()
    {
        // Code để cập nhật trạng thái đơn hàng
    }
    public function delete()
    {
        // Code để xóa đơn hàng
    }
    public function detail()
    {
        $order_id = (int)($_GET['order_id'] ?? 0);

        if ($order_id <= 0) {
            header('Location: index.php?controller=order&action=index');
            exit;
        }

        // Lấy chi tiết đơn hàng từ model (chưa có phương thức này, cần thêm vào OrderModel)
        // $order = $this->orderModel->getById($order_id);

        // include __DIR__ . '/../Views/admin/order_detail.php';
    }
    public function create()
{
    // 🔐 Kiểm tra đăng nhập
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?controller=auth&action=loginForm');
        exit;
    }

    // 🛒 Kiểm tra giỏ hàng
    if (empty($_SESSION['cart'])) {
        header('Location: index.php?controller=cart');
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $cart    = $_SESSION['cart'];

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // 📝 Tạo đơn hàng
    $order_id = $this->orderModel->create([
        'user_id'      => $user_id,
        'total_amount' => $total,
        'note'         => $_POST['note'] ?? '',
        'shipping_adress' => $_POST['shipping_address'] ?? ''
    ]);

    // 📦 Lưu chi tiết đơn hàng
    foreach ($cart as $item) {
        $this->orderModel->createOrderDetail([
            'order_id'   => $order_id,
            'product_id' => $item['product_id'],
            'unit_price'      => $item['price'],
            'quantity'   => $item['quantity']
        ]);
    }

    // 🧹 Xóa giỏ hàng
    unset($_SESSION['cart']);

 
        header("Location: index.php?controller=product&action=index");
    exit;
}

public function checkout()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 🛒 Lấy giỏ hàng
    $cart = $_SESSION['cart'] ?? [];

    // Nếu giỏ trống → quay lại
    if (empty($cart)) {
        header('Location: index.php');
        exit;
    }

    // Tính tổng tiền
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Gửi sang view
    include __DIR__ . '/../Views/client/checkout.php';
}


}
