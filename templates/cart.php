<?php 
$title = "Cart";
ob_start(); ?>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow">

<h2 class="text-2xl mb-6">Your Cart</h2>

<?php if(!empty($products)): ?>

    <?php foreach($products as $p): ?>

        <div class="flex justify-between items-center border-b py-4">

            <div>
                <p class="font-semibold"><?= $p['name'] ?></p>
                <p class="text-gray-500">Qty: <?= $p['qty'] ?></p>
                <p>$<?= $p['price'] ?></p>
            </div>

            <a href="index.php?action=remove_from_cart&id=<?= $p['id'] ?>"
               class="text-red-500">
               Remove
            </a>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>Cart is empty</p>

<?php endif; ?>

</div>

<?php
$content = ob_get_clean();
require "base.php";