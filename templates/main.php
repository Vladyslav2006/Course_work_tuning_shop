<?php
$title = "Home | Mercedes Tuning Shop";
ob_start(); ?>

<div class="w-full max-w-6xl mx-auto space-y-12">

<div class="text-center space-y-4">
    <h1 class="text-4xl font-light tracking-wide">
        Mercedes Tuning Shop
    </h1>

    <p class="text-gray-500 max-w-2xl mx-auto">
        Premium tuning parts and accessories designed for Mercedes-Benz.
        Clean design. Maximum performance. Pure style.
    </p>

    <a href="index.php?action=catalog"
       class="inline-block mt-4 bg-black text-white px-8 py-3 tracking-wide hover:bg-gray-800 transition">
        EXPLORE CATALOG
    </a>
</div>

<div class="overflow-hidden rounded-2xl shadow-lg bg-white">

    <div id="slider" class="flex transition duration-500 w-full">

        <?php
        $images = [
            "brabus.png",
            "lorinser.png",
            "wald.png",
            "amg.png",
            "mansoryW222.png",
            "mansoryW223.png",
            "amgW210.png"
        ];

        foreach($images as $img):
        ?>
            <div class="w-full flex-shrink-0 flex justify-center items-center p-6">
                <img src="car_images/<?= $img ?>" class="max-h-80 w-auto object-contain">
            </div>
        <?php endforeach; ?>

    </div>

</div>

<div class="grid md:grid-cols-3 gap-8">

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
        <h3 class="text-lg font-semibold mb-2">Premium Parts</h3>
        <p class="text-gray-500 text-sm">
            High-quality components engineered for performance and durability.
        </p>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
        <h3 class="text-lg font-semibold mb-2">Performance</h3>
        <p class="text-gray-500 text-sm">
            Improve speed, handling and overall driving experience.
        </p>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center">
        <h3 class="text-lg font-semibold mb-2">Custom Styling</h3>
        <p class="text-gray-500 text-sm">
            Interior and exterior upgrades to match your unique vision.
        </p>
    </div>

</div>

</div>

<script>
let i = 0;
const totalSlides = 7;

setInterval(()=>{
    i = (i + 1) % totalSlides;
    document.getElementById('slider').style.transform = `translateX(-${i * 100}%)`;
}, 3000);
</script>

<?php
$content = ob_get_clean();
require "base.php";