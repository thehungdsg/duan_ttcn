<?php
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<?php foreach ($cart as $item): ?>
<?php
    $sub = $item['price'] * $item['quantity'];
    $total += $sub;
?>
<div class="flex items-center gap-4 border-b pb-3">

    <img src="/Website_raumamix/Assets/img/<?= $item['image'] ?>"
         class="size-16 rounded-lg object-cover">

    <div class="flex-1">
        <p class="font-semibold"><?= $item['product_name'] ?></p>
        <p class="text-sm text-gray-500">
            <?= number_format($item['price']) ?>đ
        </p>

        <div class="flex items-center gap-2 mt-2">
            <a href="index.php?controller=cart&action=decrease&product_id=<?= $item['product_id'] ?>">−</a>
            <span><?= $item['quantity'] ?></span>
            <a href="index.php?controller=cart&action=increase&product_id=<?= $item['product_id'] ?>">+</a>
        </div>
    </div>

    <a href="index.php?controller=cart&action=remove&product_id=<?= $item['product_id'] ?>"
       class="text-red-500">X</a>
</div>
<?php endforeach; ?>
