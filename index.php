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

</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Cost Calculator</h2>
        <p class="lead">Calculate the total cost and monthly payments.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">

            <?php if (isset($errors)) : ?>
                <?php if (count($errors) > 0) : ?>

                    <h4 class="alert alert-danger d-flex justify-content-between align-items-center mb-3">
                        <strong>Invalid input</strong>
                        <span class="badge badge-secondary badge-pill"><?= count($errors) ?></span>
                    </h4>

                    <ul class='list-group alert-danger'>

                        <?php foreach ($errors as $error) : ?>
                            <li class="list-group-item"><?= $error ?></li>
                        <?php endforeach; ?>

                    </ul>

                <?php else : ?>

                    <h4 class="alert alert-success d-flex justify-content-between align-items-center mb-3">
                        <strong>Result</strong>
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
                            <span class="text-muted"><?= format($price) ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Quantity</h6>
                            </div>
                            <span class="text-muted"><?= $quantity ?></span>
                        </li>

                        <?php if ($discount != 0) : ?>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Discount</h6>
                                </div>
                                <span class="text-success"><?= round($discount, 2) ?>
                                    <small><?= $discType ?></small>
                                </span>
                            </li>
                        <?php endif; ?>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Tax</h6>
                                <small><?= $tax ?></small>

                            </div>
                            <span class="text-muted"><?= format($taxRate) ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Shipping</h6>
                                <small><?= $shipType ?></small>
                            </div>

                            <?php if ($shipping != 0) : ?>
                                <span class="text-muted"><?= format($shipping) ?></span>
                            <?php endif; ?>

                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Number of payments</h6>
                            </div>
                            <span class="text-muted"><?= $payments ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong><?= format($total) ?></strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Monthly payments</span>
                            <strong><?= format($monthly) ?></strong>
                        </li>

                    </ul>

                <?php endif; ?>
            <?php endif; ?>

        </div>


        <div class="col-md-8 order-md-1">

            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Please provide the requested information:</span>
            </h4>

            <hr class="mb-4">

            <form method="POST">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text"
                               class="form-control"
                               placeholder="Name"
                               id="name"
                               name="name"
                               value='<?= $form->prefill('name', '') ?>'>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               aria-describedby="emailHelp"
                               placeholder="you@example.com"
                               value='<?= $form->prefill('email', '') ?>'>
                        <small id="emailHelp"
                               class="form-text text-muted">We'll never share your email with anyone else.
                        </small>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="website">Website <span class="text-muted">(Optional)</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text"
                               class="form-control"
                               id="website"
                               name="website"
                               placeholder="Enter URL"
                               value='<?= $form->prefill('website', '') ?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="price">Price </label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control"
                                   id="price"
                                   name="price"
                                   placeholder="Price in US Dollar"
                                   value='<?= $form->prefill('price', '') ?>'>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number"
                               class="form-control"
                               placeholder="Quantity"
                               id="quantity"
                               name="quantity"
                               value='<?= $form->prefill('quantity', '') ?>'>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="payments">Payments</label>
                        <input type="number"
                               class="form-control"
                               placeholder="Payments"
                               id="payments"
                               name="payments"
                               value='<?= $form->prefill('payments', '') ?>'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="discount">Discount <span class="text-muted">(Optional)</span></label>
                        <input type="text"
                               class="form-control"
                               placeholder="Discount"
                               id="discount"
                               name="discount"
                               value='<?= $form->prefill('discount', '') ?>'>
                    </div>
                    <div class="col-md-6 mb-3 custom-control custom-checkbox">
                        <label for="percent">Discount Type </label>
                        <div>
                            <input type="checkbox"
                                   id="percent"
                                   name="percent" <?php if ($form->isChosen('percent')) echo 'checked' ?>>&nbsp;
                            <label for="percent"> %</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tax">Tax <span class="text-muted">(Optional)</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   id="tax"
                                   name="tax"
                                   placeholder="Tax amount"
                                   value='<?= $form->prefill('tax', '') ?>'>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="shipping">Shipping</label>
                        <select class="custom-select d-block w-100" id="shipping" name="shipping">
                            <option value=''>Choose one...</option>
                            <option value='0' <?php if ($shipping == '0') echo 'selected' ?>>Free / Pickup</option>
                            <option value='9.95' <?php if ($shipping == '9.95') echo 'selected' ?>>Standard: 1 Week $9.95</option>
                            <option value='29.95' <?php if ($shipping == '29.95') echo 'selected' ?>>Expedite: 2nd day $29.95</option>
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

</body>
</html>
