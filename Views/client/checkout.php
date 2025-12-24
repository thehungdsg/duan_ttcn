<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="mb-4">💳 Xác nhận thanh toán</h3>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tạm tính</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= number_format($item['price']) ?>đ</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'] * $item['quantity']) ?>đ</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h5 class="text-end">
        Tổng tiền:
        <span class="text-danger fw-bold">
            <?= number_format($total) ?>đ
        </span>
    </h5>

    <!-- FORM ĐẶT HÀNG -->
    <form method="post" action="index.php?controller=order&action=create">
        <div class="mb-3">
            <label class="form-label">Ghi chú đơn hàng</label>
            <textarea name="note" class="form-control"
                      placeholder="Ví dụ: giao buổi sáng..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Địa chỉ giao hàng</label>
            <textarea name="shipping_address" class="form-control"
                      placeholder="Ví dụ: 123 Đường ABC, Quận XYZ, TP. HCM"></textarea>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php?controller=cart" class="btn btn-secondary">
                ← Quay lại giỏ hàng
            </a>

            <button type="submit" class="btn btn-success">
                ✅ Xác nhận đặt hàng
            </button>
        </div>
    </form>
</div>

</body>
</html>
