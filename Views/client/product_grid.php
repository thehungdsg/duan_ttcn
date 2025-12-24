<div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

    <?php foreach ($products as $p): ?>
        <div
            class="product-item bg-white rounded-xl shadow hover:shadow-lg transition cursor-pointer group"
            data-name="<?= strtolower(htmlspecialchars($p['product_name'])) ?>"

            onclick="openProductModal(
                '<?= htmlspecialchars($p['product_name']) ?>',
                '<?= number_format($p['price']) ?>đ',
                '<?= $p['discount'] ?>',
                '<?= htmlspecialchars($p['category_name']) ?>',
                'Assets/img/<?= $p['image'] ?>',
                '<?= $p['product_id'] ?>'
            )">

            <!-- IMAGE -->
            <div class="relative overflow-hidden">
                <img
                    src="Assets/img/<?= $p['image'] ?>"
                    class="w-full h-40 object-cover rounded-t-xl group-hover:scale-105 transition">

                <?php if ($p['discount'] > 0): ?>
                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                        -<?= $p['discount'] ?>%
                    </span>
                <?php endif; ?>
            </div>

            <!-- CONTENT -->
            <div class="p-3">
                <h3 class="font-semibold text-sm line-clamp-2 mb-1">
                    <?= htmlspecialchars($p['product_name']) ?>
                </h3>

                <p class="text-green-600 font-bold text-sm">
                    <?= number_format($p['price']) ?>đ
                </p>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<!-- MESSAGE KHÔNG CÓ KẾT QUẢ -->
<p id="noResult"
   class="hidden text-center text-gray-500 col-span-full mt-6">
    Không tìm thấy sản phẩm phù hợp 😥
</p>


<script>
const searchInput = document.getElementById('searchInput');
const products = document.querySelectorAll('.product-item');
const noResult = document.getElementById('noResult');

searchInput.addEventListener('input', function () {
    const keyword = this.value.toLowerCase().trim();
    let count = 0;

    products.forEach(product => {
        const name = product.dataset.name;

        if (name.includes(keyword)) {
            product.classList.remove('hidden');
            count++;
        } else {
            product.classList.add('hidden');
        }
    });

    // Hiện thông báo nếu không có sản phẩm
    if (count === 0) {
        noResult.classList.remove('hidden');
    } else {
        noResult.classList.add('hidden');
    }
});
</script>
