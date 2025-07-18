<?php
include 'products_data.php';
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$selectedId || !isset($products[$selectedId-1])) {
    echo "<h2 class='text-red-500 p-6'>Invalid product selected.</h2>";
    exit;
}

$product = $products[$selectedId-1];

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-commerce</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=credit_card" />
  </head>
  <body class="font-display bg-[#f5f6f7] text-gray-900">
    <header class="bg-white shadow-sm p-4">
      <h1 class="text-[20px] font-bold text-center">E-commerce Site</h1>
    </header>
    <main>
      <section class="container mx-auto p-4">
        <div class="mx-auto w-[600px]">
            <div class="bg-white p-6 mt-4 rounded-[8px] shadow-sm">
                <header class="text-lg font-semibold mb-4">Checkout</header>
                <section>
                    <form action="pay.php" method="post">
                        <div class="mb-8">
                            <div class="mb-2">
                                <div class="text-sm">
                                    <span>Subtotal</span>
                                    <span class="float-right">$<?php echo $product['price'] ?></span>
                                </div>
                            </div>
                            <div class="border-b border-gray-200 border-dashed"></div>
                            <div class="mt-2">
                                <div class="text-sm font-bold">
                                    <span>Order total</span>
                                    <span class="float-right">$<?php echo $product['price'] ?></span>
                                    <input type="hidden" id="price" name="price" value="<?php echo $product['price'] ?>">
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 border-gray-300" />
                        <div class="mt-2 mb-8">
                            <div>
                                <small class="font-bold">Contact</small>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-full">
                                    <select name="country" class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3">
                                        <option value="CA">+1 Canada</option>
                                    </select>
                                </div>
                                <div class="w-full">
                                    <input required name="phone_number" type="tel" placeholder="Phone number" class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4" />
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-full">
                                    <input required name="email" type="email" placeholder="Email address for receipt" class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4" />
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-full">
                                    <input required name="first_name" type="text" placeholder="First name" class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4" />
                                </div>
                                <div class="w-full">
                                    <input required name="last_name" type="text" placeholder="Last name" class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4" />
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 border-gray-300" />
                        <div class="mb-8">
                            <div class="mb-4">
                                <small class="font-bold">Payment</small>
                                <div class="text-gray-400 text-base font-normal">All transactions are secure and encrypted</div>
                            </div>
                            <div class="border-2 rounded-[8px] p-6">
                                <div>
                                    <span class="text-sm font-medium">Card details</span>
                                    <span class="float-right material-symbols-outlined">credit_card</span>
                                </div>
                                <div class="py-4">
                                    <input
                                            required
                                            id="card_number"
                                            name="card_number"
                                            type="text"
                                            inputmode="numeric"
                                            pattern="^\d{13,19}$"
                                            maxlength="19"
                                            placeholder="Card number"
                                            title="Card number must be 13 to 19 digits"
                                            class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4"
                                    />

                                    <div class="flex gap-4">
                                        <div class="w-full">
                                            <input
                                                    required
                                                    name="expiry"
                                                    type="text"
                                                    placeholder="MM/YY"
                                                    pattern="^(0[1-9]|1[0-2])\/\d{2}$"
                                                    maxlength="5"
                                                    title="Expiry must be in MM/YY format"
                                                    class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4"
                                            />
                                        </div>
                                        <div class="w-full">
                                            <input required name="cvv" type="text" placeholder="CVV" class="w-full mt-2 bg-white border border-gray-300 rounded-md p-3 px-4" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4 border-gray-300" />
                        <button type="submit" class="block mt-4 bg-blue-500 text-white font-bold text-sm px-4 py-4 cursor-pointer rounded-[8px] w-full">Checkout</button>
                        <div class="mt-4 text-gray-500">
                            <span class="text-sm">By clicking Checkout, you authorize this transaction, and agree it is non-refundable and made the purchase.</span>
                        </div>
                    </form>
                </section>
            </div>
        </div>
      </section>
    </main>
    <footer class="mt-4">
      <div class="container mx-auto p-4">
        <p class="text-sm text-gray-500 text-center">
          © 2025 E-commerce Site. All rights reserved.
        </p>
      </div>
    </footer>
  </body>
</html>
