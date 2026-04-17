<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $title ?? "Mercedes Tuning Shop" ?></title>

<link rel="icon" type="image/x-icon" href="car_images/favicon.ico">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col"
      style="font-family:Montserrat">

<header class="bg-white border-b border-gray-200">

    <div class="max-w-6xl mx-auto flex justify-between items-center px-6 py-4">

        <div class="flex items-center gap-3">
            <img src="car_images/mercedes.png" alt="Logo" class="w-10 h-10 object-contain">
            <h1 class="text-lg font-light tracking-wide">
                Mercedes Tuning Shop
            </h1>
        </div>

        <nav class="hidden md:flex gap-6 text-sm font-medium text-gray-600">

            <a href="index.php" class="hover:text-black transition">Home</a>
            <a href="index.php?action=catalog" class="hover:text-black transition">Catalog</a>
            <a href="index.php?action=info" class="hover:text-black transition">Info</a>
            <a href="index.php?action=support" class="hover:text-black transition">Support</a>

            <?php if(isset($_SESSION['user'])): ?>
                <a href="index.php?action=cart" class="hover:text-black transition flex items-center gap-1">
                    🛒 Cart
                </a>
            <?php endif; ?>

        </nav>

        <div class="flex gap-4 items-center text-sm">

            <?php if(isset($_SESSION['user'])): ?>

                <span class="text-gray-700 font-medium">
                    <?= htmlspecialchars($_SESSION['user']['login']) ?>
                </span>

                <?php if(!empty($_SESSION['user']['isAdmin'])): ?>
                    <span class="text-green-600 text-xs font-semibold tracking-wide">
                        ADMIN
                    </span>
                <?php endif; ?>

                <a href="index.php?action=logout" 
                   class="text-gray-500 hover:text-black transition">
                   Logout
                </a>

            <?php else: ?>

                <a href="index.php?action=login" 
                   class="px-4 py-2 border border-black text-black hover:bg-black hover:text-white transition rounded-lg">
                   Login
                </a>

            <?php endif; ?>

        </div>

    </div>

</header>

<main class="flex-grow flex flex-col items-center px-4 py-10">
    <?= $content ?>
</main>

<footer class="bg-white border-t border-gray-200 py-6 mt-10">
    <div class="max-w-6xl mx-auto text-center text-sm text-gray-500">
        © <?= date('Y') ?> Mercedes Tuning Shop
    </div>
</footer>

</body>
</html>