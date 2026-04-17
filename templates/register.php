<?php 
$title = "Register | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-md bg-white border border-gray-100 rounded-2xl shadow-sm p-8 space-y-6">

        <div class="text-center space-y-2">
            <h2 class="text-2xl font-light tracking-wide">Create Account</h2>
            <p class="text-sm text-gray-500">Join Mercedes Tuning Shop</p>
        </div>

        <form method="post" class="flex flex-col gap-4">

            <input 
                name="login" 
                placeholder="Login"
                required
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Password"
                required
                class="px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <button 
                class="bg-black text-white py-3 rounded-lg tracking-wide hover:bg-gray-800 transition"
            >
                REGISTER
            </button>

            <?php if(!empty($error)): ?>
                <p class="text-red-500 text-sm text-center"><?= $error ?></p>
            <?php endif; ?>

        </form>

        <div class="text-center text-sm">
            <a href="index.php?action=login" class="text-gray-500 hover:text-black transition">
                Back to Login
            </a>
        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";