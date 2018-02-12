<?php
require('Form.php');

$form = new ALA\Form($_POST);

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
}
