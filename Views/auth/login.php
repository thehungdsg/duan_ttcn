<?php
if ($_SESSION['user'] ?? false) {
    header('Location: index.php'); // Nếu đã đăng nhập thì chuyển hướng về trang chủ
    exit;
}

?>

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
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 to-green-200">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-green-700 mb-6">
            Đăng nhập hệ thống
        </h2>

        <!-- Error -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="index.php?controller=auth&action=login" class="space-y-4">

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    required
                    placeholder="example@gmail.com"
                    class="w-full h-11 rounded-lg border border-gray-300 px-4
                           focus:outline-none focus:ring-2 focus:ring-green-400
                           focus:border-green-400"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Mật khẩu
                </label>
                <input
                    type="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full h-11 rounded-lg border border-gray-300 px-4
                           focus:outline-none focus:ring-2 focus:ring-green-400
                           focus:border-green-400"
                >
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full h-11 rounded-lg bg-green-600 text-white font-semibold
                       hover:bg-green-700 transition duration-200"
            >
                Đăng nhập
            </button>
        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-6">
            © <?= date('Y') ?> Rau Má Mix
        </p>
    </div>
</div>

</body>
</html>