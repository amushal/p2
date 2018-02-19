<?php
require('includes/Form.php');
require('includes/MyForm.php');

$form = new Mushal\MyForm($_POST);
//$post = $_POST ?? '';

# Version 2
//$tax = isset($_POST['tax']) && $_POST['tax'] != '' ? $_POST['tax'] : 0;

if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'name' => 'alpha',
            'product' => 'alphaNumeric|max:25',
            'email' => 'email',
            'website' => 'url',
            'price' => 'required|float|min:0|max:1000000',
            'quantity' => 'required|min:0|max:1000',
            'payments' => 'required|min:0|max:1000',
            'discount' => 'min:0|max:100',
            'tax' => 'min:0|max:100'
        ]
    );

    if (!$form->hasErrors) {

        # Init
        $taxRate = 0;
        $shipType = '';
        $monthly = 0;
        $total = 0;

        # Get the Form data need for calculation
        $price = $form->get('price');
        $quantity = $form->get('quantity');
        $tax = $form->get('tax');
        $discount = (float)$form->get('discount');
        $percent = $form->has('percent');
        $payments = $form->get('payments');
        $shipping = $form->get('shipping');

        // Calculate the total:
        $total = $price * $quantity;
        $total = $total + (float)$shipping;

        // Factor discount amount based on selected type (Percent or Dollar value)
        $discType = '';
        if ($percent) {
            $discType = '%';
            $total = $total * (1 - $discount / 100);
        } else {
            $discType = ' dollars off';
            $total = $total - $discount;
        }

        // Determine the tax:
        if ($tax == '') {
            $tax = 'no Tax';
        } else {
            $taxRate = ($tax / 100) + 1;
            $total = $total * $taxRate;
        }

        // Will not allow negative results at runtime
        if ($total < 0) {
            $errors = ['error' => '"Total" result cannot be less than 0'];
        }

        // Calculate the monthly payments:
        $monthly = $total / $payments;

        if ($shipping == '0')
            $shipType = 'Free / Pickup';
        else if ($shipping == '9.95')
            $shipType = 'Standard: 1 Week $9.95';
        else if ($shipping == '29.95')
            $shipType = 'Expedite: 2nd day $29.95';
        else {
            $shipType = 'Not selected';
            $shipping = '';
        }
    }

    function format($value, $percent = null)
    {
        $result = number_format($value, 2, '.', ',');
        if (is_null($percent))
            return '$' . $result;
        else
            return $result . '%';
    }
}
