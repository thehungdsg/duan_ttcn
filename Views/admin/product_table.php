
<?php
include __DIR__ . '/../../Assets/css/admin/headerAdmin.php';
include('product_start.php');
include('product_actions.php');
?>

<div class="flex flex-col overflow-hidden rounded-xl border border-surface-border-light bg-surface-light shadow-md">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-surface-border-light">
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider w-20">Ảnh</th>
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider">Tên sản phẩm</th>
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider">Giá cứng</th>
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider">Discount</th>
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider">Danh mục</th>
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider">Trạng thái</th>
                    <th class="px-6 py-4 text-xs font-semibold text-text-secondary uppercase tracking-wider text-right">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-border-light">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="size-12 rounded-lg bg-center bg-cover border shadow-sm"
                                    style="background-image: url('/Website_raumamix/Assets/img/<?= htmlspecialchars($product['image']) ?>');"
                                    title="<?= htmlspecialchars($product['product_name']) ?>">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-text-primary text-base font-bold"><?= htmlspecialchars($product['product_name']) ?></span>
                                    <span class="text-text-secondary text-xs">Mã SP: <?= htmlspecialchars($product['product_id']) ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-text-primary text-sm font-bold"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($product['discount'] > 0): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-red-100 text-red-600">
                                        <?= htmlspecialchars($product['discount']) ?>%
                                    </span>
                                <?php else: ?>
                                    <span class="text-text-secondary text-sm font-medium">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-text-secondary text-sm font-medium"><?= htmlspecialchars($product['category_name']) ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php 
                                    $is_active = $product['is_active'] == 1;
                                    $status = $is_active ? 'Hết hàng' : 'Còn hàng';
                                    $status_class = $is_active ? 'bg-status-error-bg text-status-error-text border-red-200' : 'bg-status-success-bg text-status-success-text border-green-200';
                                ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $status_class ?>">
                                    <?= $status ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="index.php?controller=product&action=editForm&product_id=<?= $product['product_id'] ?>"class="text-blue-600 hover:underline">Sửa</a>
                            
                                        <a href="index.php?controller=product&action=delete&product_id=<?= $product['product_id'] ?>"
                                        class="flex items-center gap-1.5 px-3 py-1.5 text-text-secondary hover:text-status-error-text hover:bg-red-50 rounded-md transition-colors"
                                        title="Xóa"
                                        onClick="return confirm('Are you sure you want to delete this contact?');">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                        Delete
                                        </a>
                        
                                   
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="group hover:bg-gray-50 transition-colors"><td colspan="7" class="px-6 py-6 text-center text-text-secondary">Không tìm thấy sản phẩm nào hoặc lỗi kết nối dữ liệu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="C:\xampp\htdocs\Website_raumamix\Assets\img\raumasaurieng.jpg" alt="">
</body>
</html>