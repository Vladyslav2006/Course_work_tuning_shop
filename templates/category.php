<?php 

$title = ($category['name'] ?? 'Category') . " | Mercedes Tuning Shop";

ob_start(); 
?>

<div class="min-h-[80vh] w-full max-w-6xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row justify-between md:items-center gap-6">

        <div class="space-y-2">
            <h2 class="text-2xl font-light tracking-wide">
                <?= htmlspecialchars($category['name'] ?? 'Category') ?>
            </h2>
            <div class="w-12 h-[2px] bg-black"></div>
        </div>

        <form method="get" class="flex gap-2">

            <input type="hidden" name="action" value="category">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">

            <input 
                type="text" 
                name="search" 
                placeholder="Search..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                class="border border-gray-200 px-4 py-2 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <button class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
                Search
            </button>

        </form>

    </div>

    <?php if(!empty($_SESSION['user']['isAdmin'])): ?>

        <div class="text-right">
            <a href="index.php?action=add&category_id=<?= htmlspecialchars($_GET['id'] ?? '') ?>" 
               class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition tracking-wide">
               + ADD PRODUCT
            </a>
        </div>

    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    <?php if(isset($products) && $products instanceof mysqli_result && $products->num_rows > 0): ?>

        <?php while($row = $products->fetch_assoc()): ?>

            <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md transition group">

                <a href="index.php?action=details&id=<?= $row['id'] ?>">
                    <img src="/sr/<?= htmlspecialchars($row['image']) ?>" 
                        class="mb-4 w-full h-44 object-contain group-hover:scale-105 transition duration-300"
                        alt="<?= htmlspecialchars($row['name'] ?? '') ?>"
                    >
                </a>

                <h3 class="font-medium text-lg mb-2 group-hover:text-black text-gray-800 transition">
                    <?= htmlspecialchars($row['name'] ?? '') ?>
                </h3>

                <p class="text-black font-semibold mb-2">
                    $<?= htmlspecialchars($row['price'] ?? '') ?>
                </p>

                <p class="text-sm text-gray-500 mb-4 line-clamp-3">
                    <?= htmlspecialchars($row['description'] ?? '') ?>
                </p>

                <?php if(!empty($_SESSION['user']['isAdmin'])): ?>

                    <div class="flex gap-2 mt-3">

                        <a href="index.php?action=edit&id=<?= $row['id'] ?>" 
                           class="bg-yellow-400 px-3 py-1 rounded text-white hover:bg-yellow-500 transition text-sm">
                           Edit
                        </a>

                        <a href="index.php?action=delete&id=<?= $row['id'] ?>" 
                           class="bg-red-500 px-3 py-1 rounded text-white hover:bg-red-600 transition text-sm"
                           onclick="return confirm('Delete this product?')">
                           Delete
                        </a>

                    </div>

                <?php endif; ?>

            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="col-span-3 text-center py-16 space-y-4">

            <p class="text-gray-500 text-lg">
                No products in this category
            </p>

            <?php if(!empty($_SESSION['user']['isAdmin'])): ?>

                <a href="index.php?action=add&category_id=<?= htmlspecialchars($_GET['id'] ?? '') ?>" 
                   class="inline-block bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition tracking-wide">
                   ADD FIRST PRODUCT
                </a>

            <?php endif; ?>

        </div>

    <?php endif; ?>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";