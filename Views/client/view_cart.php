<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>

    <?php if (empty($cart)): ?>
        <p>Giỏ hàng trống</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $total = 0;
            foreach ($cart as $item):
                $subTotal = $item['price'] * $item['quantity'];
                $total += $subTotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['product_name']) ?></td>
                    <td><?= number_format($item['price']) ?>đ</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($subTotal) ?>đ</td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>

        <h5 class="text-end">
            Tổng tiền:
            <span class="text-danger"><?= number_format($total) ?>đ</span>
        </h5>
    <?php endif; ?>

    <a href="index.php" class="btn btn-primary mt-3">
        ← Tiếp tục mua hàng
    </a>

    <a href="index.php?controller=order&action=checkout" class="btn btn-primary mt-3">
    Thanh toán
</a>

</div>

</body>
</html>
