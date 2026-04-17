<?php 
$title = "Login | Mercedes Tuning Shop";
ob_start(); ?>

<div class="min-h-[80vh] flex items-center justify-center bg-gray-50">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-gray-100 space-y-6">

        <div class="text-center space-y-2">
            <h1 class="text-2xl font-light tracking-wide">Sign In</h1>
            <p class="text-sm text-gray-500">Access your Mercedes Tuning account</p>
        </div>

        <form method="post" class="flex flex-col gap-4">

            <input 
                name="login" 
                placeholder="Login" 
                required 
                class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Password" 
                required 
                class="p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-1 focus:ring-black"
            >

            <button 
                class="bg-black text-white py-3 rounded-lg tracking-wide hover:bg-gray-800 transition"
            >
                LOGIN
            </button>

            <?php if(!empty($error)): ?>
                <p class="text-red-500 text-sm text-center"><?= $error ?></p>
            <?php endif; ?>

        </form>

        <div class="flex flex-col gap-2 text-center text-sm text-gray-500">
            <a href="index.php?action=register" class="hover:text-black transition">
                Don't have an account?
            </a>
            <a href="index.php?action=forgot" class="hover:text-black transition">
                Forgot password?
            </a>
        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
require "base.php";