
<?php
include __DIR__ . '/../../Assets/css/admin/headerAdmin.php';
?>
<h2 class="text-2xl font-bold mb-6">Danh sách đơn hàng</h2>

<div class="overflow-x-auto bg-white rounded-xl shadow border">
<table class="w-full border-collapse">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Khách hàng</th>
            <th class="p-3">Tổng tiền</th>
            <th class="p-3">Ghi chú</th>
            <th class="p-3">Ngày tạo</th>
            <th class="p-3">Hành động</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr class="border-t hover:bg-gray-50">
            <td class="p-3"><?= $order['order_id'] ?></td>
            <td class="p-3"><?= htmlspecialchars($order['name']) ?></td>
            <td class="p-3"><?= number_format($order['total_amount']) ?>đ</td>
            <td class="p-3"><?= $order['note'] ?></td>
            <td class="p-3"><?= $order['order_date'] ?></td>
            <td class="p-3">
                <a class="text-primary-dark font-medium hover:underline"
                   href="index.php?controller=order&action=detail&order_id=<?= $order['order_id'] ?>">
                    Xem
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

