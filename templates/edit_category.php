<?php 
$title = "Edit Category";
ob_start(); 
?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-xl bg-white border border-gray-100 rounded-2xl shadow-sm p-8 space-y-6">

        <div class="text-center space-y-2">
            <h2 class="text-2xl font-light tracking-wide">Edit Category</h2>
            <p class="text-sm text-gray-500">Update category details</p>
        </div>

        <form method="post" enctype="multipart/form-data" class="flex flex-col gap-4">

            <input type="hidden" name="id" value="<?= $category['id'] ?>">

            <input 
                name="name" 
                value="<?= htmlspecialchars($category['name']) ?>"
                required
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <?php if(!empty($category['image'])): ?>
                <div class="text-center">
                    <p class="text-sm text-gray-500 mb-2">Current Image</p>
                    <img src="/sr/<?= htmlspecialchars($category['image']) ?>" 
                         class="max-h-40 mx-auto rounded-lg border">
                </div>
            <?php endif; ?>

            <div class="flex flex-col gap-2">

                <label class="text-sm text-gray-600">
                    Replace Image
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

            <button class="bg-black text-white py-3 rounded-lg tracking-wide hover:bg-gray-800 transition">
                UPDATE CATEGORY
            </button>

        </form>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";