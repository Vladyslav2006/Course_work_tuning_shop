<?php 
$title = "Edit Product | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-xl bg-white border border-gray-100 rounded-2xl shadow-sm p-8 space-y-6">

        <div class="text-center space-y-2">
            <h2 class="text-2xl font-light tracking-wide">Edit Product</h2>
            <p class="text-sm text-gray-500">Update product information</p>
        </div>

        <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">

            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <input type="hidden" name="category_id" value="<?= $product['category_id'] ?>">

            <input 
                type="text" 
                name="name" 
                value="<?= htmlspecialchars($product['name']) ?>" 
                placeholder="Name"
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <textarea 
                name="description" 
                rows="4"
                placeholder="Description"
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black resize-none"
            ><?= htmlspecialchars($product['description']) ?></textarea>

            <input 
                type="number" 
                name="price" 
                value="<?= $product['price'] ?>" 
                placeholder="Price"
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <input 
                type="text" 
                name="country" 
                value="<?= htmlspecialchars($product['country'] ?? '') ?>" 
                placeholder="Country"
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <?php if(!empty($product['image'])): ?>
                <div class="space-y-2">
                    <p class="text-sm text-gray-500">Current Image:</p>
                    <img 
                        src="/sr/<?= $product['image'] ?>" 
                        class="h-32 object-contain rounded-lg border border-gray-100 p-2"
                    >
                </div>
            <?php endif; ?>

            <div class="flex flex-col gap-2">

                <label class="text-sm text-gray-600">
                    Change Image
                </label>

                <label class="cursor-pointer bg-black text-white px-5 py-3 rounded-lg text-center hover:bg-gray-800 transition tracking-wide">
                    Choose File
                    <input 
                        type="file" 
                        name="image" 
                        class="hidden"
                        onchange="document.getElementById('fileName').innerText = this.files[0]?.name || 'No file chosen'"
                    >
                </label>

                <span id="fileName" class="text-sm text-gray-500">
                    No file chosen
                </span>

            </div>

            <button 
                class="bg-black text-white py-3 rounded-lg tracking-wide hover:bg-gray-800 transition"
            >
                UPDATE PRODUCT
            </button>

        </form>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";