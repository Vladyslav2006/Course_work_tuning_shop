<?php 
$title = "Add Product | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-xl bg-white border border-gray-100 rounded-2xl shadow-sm p-8 space-y-6">

        <div class="text-center space-y-2">
            <h2 class="text-2xl font-light tracking-wide">Add Product</h2>
            <p class="text-sm text-gray-500">Create a new catalog item</p>
        </div>

        <form method="post" enctype="multipart/form-data" class="flex flex-col gap-4">

            <input 
                name="name" 
                placeholder="Name"
                required
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <input 
                name="price" 
                placeholder="Price"
                required
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <input 
                name="country" 
                placeholder="Country"
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <textarea 
                name="description" 
                placeholder="Description"
                rows="4"
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black resize-none"
            ></textarea>

            <div class="flex flex-col gap-2">

                <label class="text-sm text-gray-600">
                    Product Image
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
                SAVE PRODUCT
            </button>

        </form>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";