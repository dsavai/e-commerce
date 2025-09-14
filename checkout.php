<?php
include 'products_data.php';
$selectedId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$selectedId || !isset($products[$selectedId-1])) {
    echo "<h2 class='text-red-500 p-6'>Invalid product selected.</h2>";
    exit;
}

$product = $products[$selectedId-1];



$merchantID = "0022930"; //Virtual Merchant Account ID
$merchantUserID = "apiuser"; //Virtual Merchant  User ID
$merchantPinCode = "RO9A6ZRWZC5Q3WACS5RMTHYE3NE98Y5C0UT6T8TVQM5HUV8PE2QB6UYVCNKEYW80"; //Converge PIN
$vendorID = "0022930"; //Vendor ID

$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
//$url = "https://api.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

// Read the following querystring variables

//$amount = $_POST['ssl_amount']; //Post Tran Amount
$amount = $product['price']; //Post Tran Amount


$ch = curl_init();    // initialize curl handle
curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
curl_setopt($ch, CURLOPT_POST, true); // set POST method
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Set up the post fields. If you want to add custom fields, you would add them in Converge, and add the field name in the curlopt_postfields string.
curl_setopt($ch, CURLOPT_POSTFIELDS,
        "ssl_merchant_id=$merchantID".
        "&ssl_user_id=$merchantUserID".
        "&ssl_pin=$merchantPinCode".
        "&ssl_vendor_id=$vendorID".
// "&ssl_first_name=Samuel". //You can pass in values from your application and they will appear and pre-populate the HPP form
// "&ssl_avs_address=7301 Chapman Hwy". //You can pass in values from your application and they will appear and pre-populate the HPP form
// "&ssl_avs_zip=37920". //You can pass in values from your application and they will appear and pre-populate the HPP form
        "&ssl_invoice_number=Inv123".
//"&ssl_next_payment_date=03/03/2023". //used only if transaction type is ccrecurring
//"&ssl_billing_cycle=MONTHLY".  //used only if transaction type is ccrecurring
        "&ssl_transaction_type=ccsale".
        "&ssl_verify=N". //set to 'Y'if transaction type is ccgettoken, otherwise not needed
        "&ssl_get_token=Y". //pass with 'Y' if you wish to tokenize the card as part of a ccsale, do not send if transaction type set to ccgettoken
        "&ssl_add_token=Y". // should always be Y if using card manager and either transaction type is set to 'Y' or if ssl_get_token is set to 'Y'.
        "&ssl_amount=$amount" //do not pass amount if using ccgettoken as the transaction type
);


curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$result = curl_exec($ch); // run the curl process

//print_r($result);
curl_close($ch); // Close cURL

$token= $result;  //shows the session token.

?>
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
        <div class="mx-auto w-full md:w-[600px]">
            <div class="bg-white p-6 mt-4 rounded-[8px] shadow-sm">
                <header class="text-lg font-semibold mb-4">Checkout</header>
                <section>

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
                        <form action="https://api.demo.convergepay.com/hosted-payments/" method="POST" enctype="application/x-www-form-urlencoded">
                            <input id="ssl_txn_auth_token" value="<?php echo $token ?>" type="text" name="ssl_txn_auth_token" size="25" class="hidden" />
                            <div class="flex justify-center items-center w-full">
                              <button type="submit" class="block mt-2 bg-blue-500  font-bold text-white px-8 py-3 rounded-full hover:bg-blue-700 cursor-pointer">Continue to checkout</button>
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
