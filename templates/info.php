<?php 
$title = "About Us | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="max-w-3xl w-full bg-white border border-gray-100 rounded-2xl shadow-sm p-10 text-center space-y-6">

        <img 
            src="car_images/mercedes.png" 
            class="w-28 h-28 mx-auto object-contain"
        >

        <div class="space-y-2">
            <h2 class="text-3xl font-light tracking-wide">
                About Our Shop
            </h2>
            <div class="w-16 h-[2px] bg-black mx-auto"></div>
        </div>

        <p class="text-gray-600 leading-relaxed">
            Mercedes Tuning Shop is a modern online store specializing in premium tuning parts for Mercedes-Benz vehicles.
        </p>

        <p class="text-gray-600 leading-relaxed">
            We offer high-quality interior and exterior upgrades, wheels, exhaust systems, and vinyl wraps.
        </p>

        <p class="text-gray-600 leading-relaxed">
            Our goal is to help you customize your car and make it truly unique.
        </p>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";