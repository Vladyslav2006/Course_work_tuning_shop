<?php 
$title = "Support | Mercedes Tuning Shop";
ob_start(); ?>

<div class="max-w-3xl w-full bg-white shadow rounded-xl p-8 text-center">

<img src="car_images/wrench.png" class="w-24 mx-auto mb-6">

<h2 class="text-3xl mb-6 font-semibold">Support</h2>

<div class="space-y-4">

<p><b>Email:</b> support@mercedestuning.com</p>

<p><b>Phone:</b> +380 XX XXX XX XX</p>

<p><b>Working hours:</b> 09:00 - 18:00</p>

</div>

</div>

<?php
$content=ob_get_clean();
require "base.php";