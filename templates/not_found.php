<?php 
$title = "404 Not Found | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="flex flex-col items-center text-center space-y-6">

        <img src="image.png" class="w-40 object-contain">

        <div class="space-y-2">
            <h2 class="text-4xl font-light tracking-wide">
                404
            </h2>
            <h3 class="text-xl font-medium text-gray-700">
                Page Not Found
            </h3>
        </div>

        <p class="text-gray-500 max-w-md">
            The page you are looking for does not exist or has been moved.
        </p>

        <a href="index.php"
           class="bg-black text-white px-8 py-3 rounded-lg tracking-wide hover:bg-gray-800 transition">
            GO HOME
        </a>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";