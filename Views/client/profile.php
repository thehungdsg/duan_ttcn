<?php
// CHỈ start session nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If controller passed $user, use it; otherwise fall back to session-stored user
if (!isset($user)) {
    $user = $_SESSION['user'] ?? null;
}
?>

<!-- PROFILE MODAL -->
<div id="profileModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">

    <div class="bg-white dark:bg-[#112218] w-full max-w-md rounded-xl shadow-xl p-6 relative">

        <!-- CLOSE -->
        <button onclick="closeProfileModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-black dark:hover:text-white">
            ✕
        </button>

        <h2 class="text-xl font-bold mb-4 text-center">
            Thông tin khách hàng
        </h2>

        <?php if ($user): ?>
            <div class="space-y-2 text-sm">
                <p><strong>Họ tên:</strong>
                    <?= htmlspecialchars($user['name'] ?? 'Chưa cập nhật') ?>
                </p>

                <p><strong>Email:</strong>
                    <?= htmlspecialchars($user['email'] ?? 'Chưa cập nhật') ?>
                </p>

                <p><strong>SĐT:</strong>
                    <?= htmlspecialchars($user['phone'] ?? 'Chưa cập nhật') ?>
                </p>

                <p><strong>Địa chỉ:</strong>
                    <?= htmlspecialchars($user['address'] ?? 'Chưa cập nhật') ?>
                </p>

                <p><strong>Vai trò:</strong>
                    <?= ($user['role'] ?? 0) == 1 ? 'Admin' : 'Khách hàng' ?>
                </p>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="index.php?controller=auth&action=logout"
                   class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                    Đăng xuất
                </a>

                <button onclick="closeProfileModal()"
                        class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 dark:bg-[#234833] dark:text-white">
                    Đóng
                </button>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500">
                Bạn chưa đăng nhập
            </p>
        <?php endif; ?>

    </div>
</div>

<script>
function openProfileModal() {
    const modal = document.getElementById('profileModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeProfileModal() {
    const modal = document.getElementById('profileModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
