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
<body class="bg-background-light min-h-screen flex flex-col font-display text-text-primary overflow-x-hidden antialiased">
<div class="layout-container flex h-full grow flex-col">
<header class="sticky top-0 z-50 flex items-center justify-between whitespace-nowrap border-b border-solid border-b-surface-border-light bg-surface-light px-10 py-3 shadow-sm">
<div class="flex items-center gap-4 text-text-primary">
<div class="size-8 flex items-center justify-center text-primary-dark">
<span class="material-symbols-outlined !text-[32px]">local_cafe</span>
</div>
<h2 class="text-text-primary text-lg font-bold leading-tight tracking-[-0.015em]">Rau Má Mix Admin</h2>
</div>
<div class="flex flex-1 justify-end gap-8">
<div class="flex items-center gap-9 hidden md:flex">
<a class="text-text-secondary hover:text-primary-dark transition-colors text-sm font-medium leading-normal" href="#">Dashboard</a>
<a class="text-text-secondary hover:text-primary-dark transition-colors text-sm font-medium leading-normal" href="index.php?controller=order&action=index">Đơn Hàng</a>
<a class="text-text-secondary hover:text-primary-dark transition-colors text-sm font-medium leading-normal" href="index.php?controller=product&action=index">Sản Phẩm</a>
<a
  href="index.php?controller=auth&action=logout"
  class="text-text-secondary hover:text-primary-dark transition-colors text-sm font-medium leading-normal"
>
    Đăng xuất
</a>

</div>
<div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 border border-surface-border-light cursor-pointer hover:opacity-80 transition-opacity" data-alt="Admin user profile picture showing a smiling person" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDd3st63FmrbGiw0eJ5VsX4vXR5YP3qDfBeYzR2TIHQbcCcfibt90cz3jjHurMZhPKNAUZ5rI9UA7JAQ8K9jVpfbg_5_b8-o_A_HZkb_JF9rT1mu-Q61LmaU_T-XkioJ2apUGKK7gtECPGx-nSB63rqvaRiZy1m2i5MTQ0IbHTpImlLgYByHWHlcDfy0je9ZKxo5A7SGOJi-FAGYCxIRn8g8ibWXT9xk1s3JlPPg_O76fwDmfct5rvKI5G-XSea7OabhrV_J3GSMt2J");'></div>
</div>
</header>
<main class="flex flex-1 flex-col items-center py-8">
<div class="layout-content-container flex flex-col max-w-[1200px] w-full flex-1 px-4 md:px-10 gap-6">