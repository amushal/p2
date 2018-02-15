<?php
require('includes/Form.php');

function format($value)
{
    return '$' . number_format($value, 2, '.', ',');
}

#testing
function dump($mixed = null)
{
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
}

$form = new P2\Form($_POST);
$post = $_POST ?? '';
$total = 0;

# Version 2
$tax = isset($_POST['tax']) && $_POST['tax'] != '' ? $_POST['tax'] : 0;

if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'name' => 'alpha',
            'email' => 'email',
            'website' => 'url',
            'price' => 'required|float|min:0|max:1000000',
            'quantity' => 'required|min:0|max:1000',
            'payments' => 'required|min:0|max:1000',
            'discount' => 'min:0|max:100',
            'tax' => 'min:0',
            //'total' => 'min:0'
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

        // Calculate the total:
        $total = $price * $quantity;
        $total = $total + $shippingCost;

        // Factor discount amount based on selected type (Percent or Dollar value)
        $discType = "";
        if ($percent) {
            $discType = "%";
            $total = $total * (1 - $discount / 100);
        } else {
            $discType = " dollars off";
            $total = $total - $discount;
        }

        // Determine the tax rate:
        $taxRate = $tax / 100;
        $taxRate = $taxRate + 1;

        // Factor in the tax rate:
        $total = $total * $taxRate;
        if ($total < 0) {
            $errors = ['error' => '"Total" result cannot be less than 0'];
        }

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
