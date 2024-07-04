<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cantidad = $_POST['cantidad'];
    $cantidad = $cantidad * 100;
}

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PS4AsITdjaBdp7uMkvIL4QsoPis8hVmzo4fuYY42as1v3l2qEbY5wb4uN4CKpPuLUwDSf4c0jMi1p08t7VqJZgo003wkGuDhB";

\Stripe\Stripe::setApiKey($stripe_secret_key);


$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/INTEGRADORA_OFICIALE4/INTEGRADORAOFICIAL_E4/Stripe/success.php",
    "cancel_url" => "http://localhost/INTEGRADORA_OFICIALE4/INTEGRADORAOFICIAL_E4/Stripe/index.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "Mxn",
                "unit_amount" => $cantidad,
                "product_data" => [
                    "name" => "Habitacion Doble"
                ]
            ]
        ]     
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);