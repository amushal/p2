<?php require 'formHandler.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Calculate product cost based on user input">
    <meta name="author" content="Ala Mushal">

    <title>Cost Calculator</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <!--    <link href="form-validation.css" rel="stylesheet">-->
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Cost Calculator</h2>
        <p class="lead">Please provide the requested information. Your responses will be used to calculate the total cost and monthly payments.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <?php if (isset($errors)) : ?>
                <?php if (count($errors) > 0) : ?>
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Invalid Input</span>
                        <span class="badge badge-secondary badge-pill"><?= count($errors) ?></span>
                    </h4>
                    <ul class='list-group alert-danger'>
                        <?php foreach ($errors as $error) : ?>
                            <li class="list-group-item"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Result</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Name</h6>
                            </div>
                            <span class="text-muted"><?= $name ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Email</h6>
                            </div>
                            <span class="text-muted"><?= $email ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Website</h6>
                            </div>
                            <span class="text-muted"><?= $website ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Price</h6>
                            </div>
                            <span class="text-muted"><?= $price ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Quantity</h6>
                            </div>
                            <span class="text-muted"><?= $qty ?></span>
                        </li>

                        <?php if ($disc != 0) : ?>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Discount</h6>
                                </div>
                                <span class="text-success"><?= $disc ?>
                                    <small><?= $discType ?></small></span>
                            </li>
                        <?php endif; ?>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Tax</h6>
                            </div>
                            <span class="text-muted"><?= $tax ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Shipping</h6>
                                <small><?= $shipType ?></small>
                            </div>
                            <span class="text-muted"><?= $shipping ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Number of payments</h6>
                            </div>
                            <span class="text-muted"><?= $payments ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong><?= $total ?></strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Monthly payments</span>
                            <strong><?= round($monthly, 2) ?></strong>
                        </li>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </div>


        <div class="col-md-8 order-md-1">
            <!--<h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Please provide the following information and then click Submit:</span>
            </h4>-->
            <br/>
            <form method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name"
                               value='<?= $form->prefill('name', '') ?>'>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                               aria-describedby="emailHelp"
                               placeholder="you@example.com" value='<?= $form->prefill('email', '') ?>'>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                                                           else.
                        </small>

                    </div>
                </div>
                <div class="mb-3">
                    <label for="website">Website <span class="text-muted">(Optional)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" class="form-control" id="website" name="website" placeholder="Enter URL"
                               value='<?= $form->prefill('website', '') ?>'>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">

                        <label for="price">Price </label>

                        <div class="input-group">

                            <input type="text"
                                   class="form-control"
                                   id="price"
                                   name="price"
                                   placeholder="Price in US Dollar"
                                   value='<?= $form->prefill('price', '') ?>'>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" placeholder="Quantity" id="qty" name="qty"
                               value='<?= $form->prefill('qty', '') ?>'>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="payments">Payments</label>
                        <input type="number" class="form-control" placeholder="Payments" id="payments"
                               name="payments"
                               value='<?= $form->prefill('payments', '') ?>'>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="disc">Discount <span class="text-muted">(Optional)</span></label>
                        <input type="number" class="form-control" placeholder="Discount" id="disc" name="disc"
                               value='<?= $form->prefill('disc', '') ?>'>
                    </div>
                    <div class="col-md-6 mb-3 custom-control custom-checkbox">
                        <label for="percent">Percentage <span class="text-muted">(%)</span></label>
                        <div>
                            <input type="checkbox"
                                   id="percent"
                                   name='percent' <?php if ($form->isChosen('percent')) echo 'checked' ?>></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tax">Tax <span class="text-muted">(Optional)</span></label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="text" class="form-control" id="tax" name="tax" placeholder="Tax amount"
                                   value='<?= $form->prefill('tax', '') ?>'>

                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="shipping">Shipping</label>
                        <select class="custom-select d-block w-100" id="shipping" name="shipping">
                            <option value='choose'>Choose one...</option>
                            <option value='0' <?php if ($shipping == '0') echo 'selected' ?>>Free / Pickup
                            </option>
                            <option value='9.95' <?php if ($shipping == '9.95') echo 'selected' ?>>Standard: 1 Week $9.95
                            </option>
                            <option value='29.95' <?php if ($shipping == '29.95') echo 'selected' ?>>Expedite: 2nd day $29.95
                            </option>
                        </select>

                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2018 Mushal.me</p>
    </footer>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>
</html>
