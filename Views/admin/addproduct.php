<?php
include __DIR__ . '/../../Assets/css/admin/headerAdmin.php';
include('product_start.php');

?>

<h2>Thêm sản phẩm</h2>

<form action="index.php?controller=product&action=store"
      method="post"
      enctype="multipart/form-data">

    <div>
        <label>Tên sản phẩm</label><br>
        <input type="text" name="product_name" required>
    </div>

   <div>
    <label for="category_id">Chọn Loại Sản phẩm:</label>

    <select name="category_id" id="category_id" required>
        <option value="">-- Chọn một loại --</option>

        <?php foreach ($categories as $category): ?>
            <option value="<?= htmlspecialchars($category['category_id']) ?>">
                <?= htmlspecialchars($category['category_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    </div>

    <div>
        <label>Giá cứng</label><br>
        <input type="number" name="price" required>
    </div>

    <div>
        <label>Discount</label><br>
        <input type="number" name="discount" required>
    </div>

    <div>
        <label>Ảnh sản phẩm</label><br>
        <input type="file" name="image" accept="image/*">
    </div>

    <button type="submit">Lưu</button>
</form>
