<?php
require('includes/Form.php');
require('includes/MyForm.php');

$form = new Mushal\MyForm($_POST);

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
        $email = $form->get('email');
        $price = $form->get('price');
        $quantity = $form->get('quantity');
        $tax = $form->get('tax');
        $discount = (float)$form->get('discount');
        $discountType = $form->get('discountType');
        $payments = $form->get('payments');
        $shipping = $form->get('shipping');
        $emailMe = $form->has('emailMe');

        // Calculate the total:
        $total = $price * $quantity;
        $total = $total + (float)$shipping;

        // Factor discount amount based on selected type (discountType or Dollar value)
        if ($discountType == '%') {
            $total = $total * (1 - $discount / 100);
        } else {
            $total = $total - $discount;
        }

        // Determine the tax:
        if ($tax == '') {
            $tax = 'no Tax';
        } else {
            $taxRate = ($tax / 100) + 1;
            $total = $total * $taxRate;
            $tax = $tax . '%';
        }

        // Will not allow negative results at runtime
        if ($total < 0) {
            array_push($errors, '"Total" result cannot be less than 0');
        }

        // Check if send via email is requested without an email address
        if ($emailMe && $email == '') {
            array_push($errors, '"Email" was not provided');
        }

        // Check if send via email is requested without an email address
        if ($discount > 0 && !$discountType) {
            array_push($errors, '"Discount type" was not specified');
        }

        //raise exception
        if (count($errors) > 0)
            $form->hasErrors = true;

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

    function format($value)
    {
        return number_format($value, 2, '.', ',');
    }
}
