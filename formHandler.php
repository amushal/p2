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
            'email' => 'required|email',
            'website' => 'required|url',
            'name' => 'alpha',
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
    $taxrate = ($tax / 100) + 1;
    $total = 0;
    $taxtype = "";

    if ($percent) {
        $taxtype = "%";
        $total = $price * $qty;
    } else {
        $taxtype = " dollars off";
        $total = $total - $disc;
    }

    $total = $total + (int)$shipping;
    $shipType = "";
    if ($shipping == "0")
        $shipType = "Ground: 5 to 7 days Free";
    else if ($shipping == "10")
        $shipType = "Standard: 1 Week $10";
    else if ($shipping == "20")
        $shipType = "Expedite: 2nd day $20";
    else
        $shipType = "Not selected";

// Factor in the tax rate:
    $total = $total * $taxrate;

    if ($payments == 0)
        $payments = 1;

// Calculate the monthly payments:
    $monthly = $total / $payments;
}
