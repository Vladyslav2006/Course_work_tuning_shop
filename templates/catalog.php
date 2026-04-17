<?php 
$title = "Catalog | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] w-full max-w-6xl mx-auto space-y-10">

    <div class="text-center space-y-2">
        <h1 class="text-3xl font-light tracking-wide">Catalog</h1>
        <div class="w-16 h-[2px] bg-black mx-auto"></div>
        <p class="text-gray-500 text-sm">Choose a category</p>
    </div>

    <?php if(!empty($_SESSION['user']['isAdmin'])): ?>
        <div class="flex justify-end gap-3">

            <a href="index.php?action=add_category"
               class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
               + ADD CATEGORY
            </a>

        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        <?php while($c = $categories->fetch_assoc()): ?>

            <div class="group bg-white border border-gray-100 rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition">

                <a href="index.php?action=category&id=<?= $c['id'] ?>">

                    <div class="mb-4 flex justify-center">

                        <?php if(!empty($c['image'])): ?>
                            <img 
                                src="/sr/<?= htmlspecialchars($c['image']) ?>" 
                                class="w-full max-h-40 object-contain group-hover:scale-105 transition duration-300"
                                alt="<?= htmlspecialchars($c['name']) ?>"
                            >
                        <?php else: ?>
                            <img 
                                src="/sr/car_images/default.png" 
                                class="w-full max-h-40 object-contain opacity-50"
                            >
                        <?php endif; ?>

                    </div>

                    <p class="text-lg font-medium tracking-wide group-hover:text-black text-gray-700 transition">
                        <?= htmlspecialchars($c['name']) ?>
                    </p>

                </a>

                <?php if(!empty($_SESSION['user']['isAdmin'])): ?>

                    <div class="mt-5 flex justify-center gap-3">

                        <a href="index.php?action=edit_category&id=<?= $c['id'] ?>"
                        class="flex items-center gap-2 px-4 py-2 text-sm text-blue-500 border border-blue-200 rounded-lg 
                                hover:bg-blue-500 hover:text-white hover:border-blue-500 
                                transition duration-300 opacity-80 hover:opacity-100">

                            Edit

                        </a>

                        <a href="index.php?action=delete_category&id=<?= $c['id'] ?>"
                        onclick="return confirm('Delete this category?')"
                        class="flex items-center gap-2 px-4 py-2 text-sm text-red-500 border border-red-200 rounded-lg 
                                hover:bg-red-500 hover:text-white hover:border-red-500 
                                transition duration-300 opacity-80 hover:opacity-100">

                            Delete

                        </a>

                    </div>

                <?php endif; ?>

            </div>

        <?php endwhile; ?>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";