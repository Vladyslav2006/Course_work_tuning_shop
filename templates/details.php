<?php 
$title = (isset($product['name']))
    ? $product['name'] . " | Mercedes Tuning Shop"
    : "Product | Mercedes Tuning Shop";

ob_start(); 
?>

<div class="min-h-[80vh] bg-gray-50 flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-md border border-gray-100 p-8">

        <?php if(isset($product) && is_array($product) && !empty($product)): ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                <div class="flex justify-center">
                    <div class="p-4 border border-gray-100 rounded-xl">
                        
                        <?php if(!empty($product['image'])): ?>
                            <img 
                                src="/sr/<?= htmlspecialchars($product['image']) ?>" 
                                class="max-h-[420px] w-auto object-contain hover:scale-105 transition duration-300"
                                alt="<?= htmlspecialchars($product['name']) ?>"
                            >
                        <?php else: ?>
                            <img 
                                src="/sr/car_images/default.png" 
                                class="max-h-[300px] opacity-50"
                            >
                        <?php endif; ?>

                    </div>
                </div>

                <div class="space-y-6">

                    <h2 class="text-3xl font-light tracking-wide text-gray-900">
                        <?= htmlspecialchars($product['name']) ?>
                    </h2>

                    <?php if(!empty($product['country'])): ?>
                        <p class="text-sm text-gray-500">
                            <span class="font-medium text-black">Country:</span> 
                            <?= htmlspecialchars($product['country']) ?>
                        </p>
                    <?php endif; ?>

                    <div class="w-16 h-[2px] bg-black"></div>

                    <p class="text-gray-600 leading-relaxed">
                        <?= htmlspecialchars($product['description'] ?? "No description") ?>
                    </p>

                    <div class="text-2xl font-semibold text-black">
                        $<?= htmlspecialchars($product['price'] ?? "0") ?>
                    </div>

                    <?php if(isset($_SESSION['user'])): ?>

                        <a href="index.php?action=add_to_cart&id=<?= $product['id'] ?>"
                           class="inline-block bg-black text-white px-8 py-3 rounded-lg tracking-wide hover:bg-gray-800 transition">
                            ADD TO CART
                        </a>

                    <?php else: ?>

                        <a href="index.php?action=login"
                           class="inline-block bg-gray-200 text-black px-8 py-3 rounded-lg">
                            Login to add to cart
                        </a>

                    <?php endif; ?>

                    <div>
                        <a href="index.php?action=catalog" 
                           class="text-sm text-gray-500 hover:text-black transition">
                            ← Back to catalog
                        </a>
                    </div>

                </div>

            </div>

        <?php else: ?>

            <div class="text-center space-y-4 py-20">

                <h2 class="text-2xl font-light tracking-wide">
                    Product not found
                </h2>

                <p class="text-gray-500">
                    The requested product does not exist or was removed.
                </p>

                <a href="index.php?action=catalog" 
                   class="inline-block bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
                    BACK TO CATALOG
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";