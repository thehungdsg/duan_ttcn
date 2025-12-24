<!DOCTYPE html>
<html class="light" lang="vi"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Quản Lý Sản Phẩm - Rau Má Mix Admin</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Noto+Sans:wght@400;500;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec6d",
                        "primary-dark": "#0ea34e",
                        "background-light": "#f8fafc","background-dark": "#112218",
                        "surface-light": "#ffffff","surface-border-light": "#e2e8f0","text-primary": "#1e293b","text-secondary": "#64748b","status-success-bg": "#dcfce7",
                        "status-success-text": "#166534",
                        "status-error-bg": "#fee2e2",
                        "status-error-text": "#991b1b",
                    },
                    fontFamily: {
                        "display": ["Manrope", "Noto Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
</head>
<body>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-green-700 mb-6 text-center">
            Sửa sản phẩm
        </h2>

        <form method="POST"
              action="index.php?controller=product&action=update"
              enctype="multipart/form-data"
              class="space-y-5">

            <!-- Hidden -->
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <input type="hidden" name="old_image" value="<?= $product['image'] ?>">

            <!-- Tên sản phẩm -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Tên sản phẩm
                </label>
                <input
                    type="text"
                    name="product_name"
                    value="<?= $product['product_name'] ?>"
                    class="w-full h-11 rounded-lg border border-gray-300 px-4
                           focus:outline-none focus:ring-2 focus:ring-green-400
                           focus:border-green-400"
                    required
                >
            </div>

            <!-- Loại -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Loại sản phẩm
                </label>
                <select
                    name="category_id"
                    class="w-full h-11 rounded-lg border border-gray-300 px-4
                           focus:outline-none focus:ring-2 focus:ring-green-400
                           focus:border-green-400"
                >
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c['category_id'] ?>"
                            <?= $c['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                            <?= $c['category_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Giá & Giảm giá -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Giá (VNĐ)
                    </label>
                    <input
                        type="number"
                        name="price"
                        value="<?= $product['price'] ?>"
                        class="w-full h-11 rounded-lg border border-gray-300 px-4
                               focus:outline-none focus:ring-2 focus:ring-green-400
                               focus:border-green-400"
                    >
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Giảm giá (%)
                    </label>
                    <input
                        type="number"
                        name="discount"
                        value="<?= $product['discount'] ?>"
                        class="w-full h-11 rounded-lg border border-gray-300 px-4
                               focus:outline-none focus:ring-2 focus:ring-green-400
                               focus:border-green-400"
                    >
                </div>
            </div>

            <!-- Ảnh -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Ảnh hiện tại
                    </label>
                    <img
                        src="Assets/img/<?= $product['image'] ?>"
                        class="h-28 rounded-lg border object-cover"
                    >
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">
                        Đổi ảnh mới
                    </label>
                    <input
                        type="file"
                        name="image"
                        class="w-full text-sm text-gray-600
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0
                               file:text-sm file:font-semibold
                               file:bg-green-50 file:text-green-700
                               hover:file:bg-green-100"
                    >
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="index.php?controller=product&action=index"
                   class="px-5 py-2 rounded-lg border border-gray-300
                          text-gray-700 hover:bg-gray-100">
                    Hủy
                </a>

                <button
                    type="submit"
                    class="px-6 py-2 rounded-lg bg-green-600 text-white
                           font-semibold hover:bg-green-700 transition"
                >
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>