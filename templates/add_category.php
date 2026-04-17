<?php 
$title = "Add Category | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-xl bg-white border border-gray-100 rounded-2xl shadow-sm p-8 space-y-6">

        <div class="text-center space-y-2">
            <h2 class="text-2xl font-light tracking-wide">Add Category</h2>
        </div>

        <form method="post" enctype="multipart/form-data" class="flex flex-col gap-4">

            <input 
                name="name" 
                placeholder="Category name"
                required
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <div class="flex flex-col gap-2">

                <label class="text-sm text-gray-600">Category Image</label>

                <label class="cursor-pointer bg-black text-white px-5 py-3 rounded-lg text-center hover:bg-gray-800 transition">
                    Choose File
                    <input type="file" name="image" class="hidden"
                        onchange="document.getElementById('fileName').innerText = this.files[0]?.name">
                </label>

                <span id="fileName" class="text-sm text-gray-500">No file chosen</span>

            </div>

            <button class="bg-black text-white py-3 rounded-lg hover:bg-gray-800">
                SAVE CATEGORY
            </button>

        </form>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";