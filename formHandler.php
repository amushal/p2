<?php
require('includes/Form.php');


function format($value){
    return '$' . number_format($value, 2, '.', ',');
}

$form = new P2\Form($_POST);
$post = $_POST ?? '';


# Version 2
$tax = isset($_POST['tax']) && $_POST['tax'] != '' ? $_POST['tax'] : 0;
function dump($mixed = null)
{
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
}

if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'name' => 'alpha',
            'email' => 'email',
            'website' => 'url',
            'price' => 'required|float',
            'quantity' => 'required|min:0',
            'payments' => 'required|min:0',
            'discount' => 'max:100',
            'tax' => 'min:-1'
        ]

    );

if (!$errors) {
    # Get the Form post values
    $name = $_POST["name"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    $price = $_POST["price"];
    $quantity = (int)$_POST["quantity"];

    //Set default values for optional parameters that are used in calculations.
    $discount = $_POST['discount'] == '' ? 0 : $_POST['discount'];
    $tax = $_POST['tax'] == '' ? 0 : $_POST['tax'];
    $percent = $_POST['percent'] ?? '';
    $shipping = $_POST["shipping"];
    $shippingCost = $shipping == '' ? 0 : $shipping;

    $payments = (int)$_POST["payments"];
    $taxRate = ($tax / 100) + 1;


    $total = $price * $quantity;

    // Factor discount amount based on selected type (Percent or Dollar value)
    $discType = "";
    if ($percent) {
        $discType = "%";
        $total = $total * (1 - $discount / 100);
    } else {
        $discType = " dollars off";
        $total = $total - $discount;
    }

    // Include shipping cost
    $total = $total + $shippingCost;

    // Factor in the tax rate:
    $total = $total * $taxRate;

    $payments = ($payments == 0) ? 1 : $payments;

    // Calculate the monthly payments:
    $monthly = $total / $payments;


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

}


}
