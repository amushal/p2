<?php
require('includes/Form.php');

$form = new P2\Form($_POST);
$shipping = $_POST['shipping'] ?? null;
$percent = $_POST['percent'] ?? '';
# Version 2
// $percent = isset($_POST['percent']) ? $_POST['percent'] : '';

if ($form->isSubmitted()) {
    $errors = $form->validate(
        [

            'name' => 'alpha',
            'email' => 'email',
            'website' => 'url',
            'price' => 'required|numeric',
            'qty' => 'required|min:0',
            'payments' => 'required|min:0',
            'disc' => 'max:100',
            'tax' => 'min:-1'
        ]
    );

    # Get the Form post values
    $name = $_POST["name"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    $price = (int)$_POST["price"];
    $qty = (int)$_POST["qty"];
    $disc = (int)$_POST["disc"];
    $tax = (int)$_POST["tax"];
    $payments = (int)$_POST["payments"];
    $taxRate = ($tax / 100) + 1;
    $shipping = $_POST["shipping"];

    $total = $price * $qty;
    $discType = "";

    if ($percent) {
        $discType = "%";
        $total = $total * (1 - $disc / 100);
    } else {
        $discType = " dollars off";
        $total = $total - $disc;
    }

    $total = $total + (int)$shipping;

    $shipType = "";
    if ($shipping == "0")
        $shipType = "Free / Pickup";
    else if ($shipping == "9.95")
        $shipType = "Standard: 1 Week $9.95";
    else if ($shipping == "29.95")
        $shipType = "Expedite: 2nd day $29.95";
    else {
        $shipType = "Not selected";
        $shipping = "";
    }
// Factor in the tax rate:
    $total = $total * $taxRate;

    $payments = ($payments == 0) ? 1 : $payments;

// Calculate the monthly payments:
    $monthly = $total / $payments;
}
