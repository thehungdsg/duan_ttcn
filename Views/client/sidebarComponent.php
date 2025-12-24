<?php

if (!isset($_SESSION['user'])) {
    include __DIR__ . '/../../Assets/css/client/header.php';
    include __DIR__ . '/../../Assets/css/client/navbar.php';
} else {
    include __DIR__ . '/../../Assets/css/client/headerIsLogin.php';
    include __DIR__ . '/../../Assets/css/client/navbar.php';
}

?>

<?php
$currentCategory = $_GET['category_id'] ?? 'all';
?>

<div class="container mx-auto px-4 py-6">

    <h2 class="text-2xl font-bold mb-4">Thực Đơn Hôm Nay</h2>

    <!-- CATEGORY -->
    <div class="flex gap-2 mb-6 flex-wrap">

        <!-- TẤT CẢ -->
        <a href="index.php?controller=product&action=index&category_id=all"
           class="px-4 py-2 rounded-full transition
           <?= $currentCategory === 'all'
                ? 'bg-green-500 text-white'
                : 'bg-gray-100 hover:bg-green-500 hover:text-white' ?>">
            Tất cả
        </a>

        <!-- CÁC CATEGORY -->
        <?php foreach ($categories as $cat): ?>
            <a href="index.php?controller=product&action=index&category_id=<?= $cat['category_id'] ?>"
               class="px-4 py-2 rounded-full transition
               <?= ($currentCategory == $cat['category_id'])
                    ? 'bg-green-500 text-white'
                    : 'bg-gray-100 hover:bg-green-500 hover:text-white' ?>">
                <?= htmlspecialchars($cat['category_name']) ?>
            </a>
        <?php endforeach; ?>

        <!-- SEARCH (GIỮ NGUYÊN GIAO DIỆN GỐC) -->
        <label class="flex flex-col min-w-40 sm:min-w-64 md:min-w-96 !h-10">
            <div class="flex w-full h-full items-stretch rounded-lg
                        ring-1 ring-[#d1d5db]
                        focus-within:ring-2 focus-within:ring-primary">

                <div class="flex items-center justify-center pl-4
                            bg-white rounded-l-lg">
                    <span class="material-symbols-outlined text-lg text-gray-500">
                        search
                    </span>
                </div>

                <input
                    id="searchInput"
                    type="text"
                    placeholder="Tìm món yêu thích..."
                    class="form-input flex w-full min-w-0 flex-1
                           resize-none overflow-hidden
                           rounded-lg rounded-l-none
                           text-[#111418]
                           focus:outline-0 focus:ring-0 border-none
                           bg-white h-full
                           px-4 pl-2 text-sm font-normal leading-normal"
                />
            </div>
        </label>

    </div>

    <!-- PRODUCT GRID -->
    <?php include 'product_grid.php'; ?>

</div>

<!-- ================= MODAL ================= -->
<div id="productModal"
     class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white w-full max-w-md rounded-xl shadow-xl p-6 relative">

        <button onclick="closeProductModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-black text-xl">
            ✕
        </button>

        <img id="modalImage"
             class="w-full h-56 object-cover rounded-lg mb-4">

        <h3 id="modalName" class="text-xl font-bold mb-2"></h3>

        <p id="modalPrice" class="text-lg font-bold text-green-600 mb-1"></p>

        <p class="text-sm mb-1">
            <strong>Danh mục:</strong>
            <span id="modalCategory"></span>
        </p>

        <p class="text-sm mb-4">
            <strong>Giảm giá:</strong>
            <span id="modalDiscount"></span>%
        </p>

        <!-- FORM THÊM GIỎ -->
        <form method="GET" action="index.php" class="space-y-3">
            <input type="hidden" name="controller" value="cart">
            <input type="hidden" name="action" value="add">

            <input type="hidden" name="product_id" id="modalProductId">
            <input type="hidden" name="openCart" value="1">

            <button type="submit" name="add_to_cart"
                class="px-4 py-2 bg-green-500 text-white rounded w-full">
                Thêm giỏ hàng
            </button>
        </form>

    </div>
</div>


<!-- ================= JS ================= -->
<script>
function openProductModal(name, price, discount, category, image, productId) {
    
    document.getElementById('modalProductId').value = productId;


    document.getElementById('modalName').innerText = name;
    document.getElementById('modalPrice').innerText = price;
    document.getElementById('modalDiscount').innerText = discount;
    document.getElementById('modalCategory').innerText = category;
    document.getElementById('modalImage').src = image;

    const modal = document.getElementById('productModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
