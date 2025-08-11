<?php include 'products_data.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Best Deal World</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=credit_card" />
  </head>
  <body class="font-display bg-[#f5f6f7] text-gray-900">
    <header>
      <?php include 'header.php'; ?>
    </header>
    <nav>
      <?php include 'menu.php'; ?>
    </nav> 
    <main>
      <section class="container mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach ($products as $product): ?>

            <?php if ($product['category'] !== 'grooming') continue; ?>
                <div class="bg-white p-4 rounded shadow">
                    <div>
                        <a href="checkout.php?id=<?= $product['id'] ?>">
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image" class="w-full h-60 object-cover rounded mb-4" />
                        </a>
                    </div>
                    <h2 class="text-md font-semibold">
                      <span class="w-full truncate block"><?= htmlspecialchars($product['name']) ?></span>
                    </h2>
                    <p class="text-gray-600 mb-2">$<?= number_format($product['price'], 2) ?></p>
                    <button class="mt-2 bg-blue-500 text-[13px] font-bold text-white px-4 py-1 rounded-full hover:bg-blue-700 cursor-pointer">
                        <a href="checkout.php?id=<?= $product['id'] ?>">Buy It Now</a>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
      </section>
    </main>
    <footer class="mt-4">
      <?php include 'footer.php'; ?>
    </footer>
  </body>
</html>
