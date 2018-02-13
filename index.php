<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Cost Calculator </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <?php require 'formHandler.php'; ?>
</head>

<body>
<section id="page">

    <header>

        <h1>Cost Calculator</h1>
    </header>

    <div class="line"></div>

    <article id="article1">

        <h3>Input information</h3>

        <div class="line"></div>

        <div class="articleBody clear">

            <section id="response">
                <h3>Output</h3>

                <?php if (isset($errors)) : ?>
                    <?php if (count($errors) > 0) : ?>
                        <div class='alert alert-danger'>
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else : ?>
                        <div>
                            Your input was:<br/>
                            Name: <?= $name ?><br/>
                            Email: <?= $email ?><br/>
                            Website: <?= $website ?><br/>

                            Price: $ <span class="number"><?= $price ?></span><br/>
                            Quantity: <span class="number"><?= $qty ?></span><br/>


                            Discount: <span class="number"><?= $disc ?></span> <?= $taxtype ?><br/>
                            Tax: <span class="number"><?= $tax ?></span>%<br/>
                            Shipping: <span class="number"><?= $shipType ?></span><br/>
                            Number of Payments: <span class="number"><?= $payments ?></span><br/>
                            <hr/>
                            Total cost is: <span class="number"><?= $total ?></span><br/>

                            Monthly payment: $<span class="number"><?= round($monthly, 2) ?></span>


                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </section>
            <form method="post">

                <section>
                    <h3>Input</h3>

                    <table>
                        <tr>
                            <td>Name</td>
                            <td>
                                <input class="rounded"
                                       type="text"
                                       name="name"
                                       value='<?= $form->prefill('name', '') ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>
                                <input class="rounded"
                                       type="text"
                                       name="email"
                                       value='<?= $form->prefill('email', '') ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>
                                <input class="rounded"
                                       type="text"
                                       name="website"
                                       value='<?= $form->prefill('website', '') ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>
                                <input type='number'
                                       class="rounded"
                                       name="price"
                                       size="5"
                                       value='<?= $form->prefill('price', '') ?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>
                                <input type='number'
                                       class="rounded"
                                       name="qty"
                                       size="5"
                                       value='<?= $form->prefill('qty', '') ?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">Discount</td>
                            <td>
                                <input type='checkbox'
                                       name='percent' <?php if ($form->isChosen('percent')) echo 'checked' ?>> Percent
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type='number'
                                       class="rounded"
                                       name="disc"
                                       size="5"
                                       value='<?= $form->prefill('disc', '') ?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>
                                <input type='number'
                                       class="rounded"
                                       name="tax"
                                       size="3"
                                       value='<?= $form->prefill('tax', '') ?>'/> %
                            </td>
                        </tr>
                        <tr>
                            <td>Shipping method</td>
                            <td>
                                <select name="shipping">
                                    <option value='choose'>Choose one...</option>
                                    <option value='0' <?php if ($shipping == '0') echo 'selected' ?>>Ground: 5 to 7 days
                                        Free
                                    </option>
                                    <option value='10' <?php if ($shipping == '10') echo 'selected' ?>>Standard: 1 Week
                                        $10
                                    </option>
                                    <option value='20' <?php if ($shipping == '20') echo 'selected' ?>>Expedite: 2nd day
                                        $20
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Number of payments</td>
                            <td>
                                <input type='number'
                                       class="rounded"
                                       name="payments"
                                       size="3"
                                       value='<?= $form->prefill('payments', '') ?>'/>
                            </td>
                        </tr>
                        <tr>
                            <td>Comment</td>
                            <td>
                                <textarea name="comment" class="rounded" rows="5" cols="40"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Submit"/>
                            </td>
                        </tr>
                    </table>

                </section>
            </form>
        </div>
    </article>

    <footer> <!-- footer section -->

        <div class="line"></div>

        <p>Copyright 2018 - mushal.me</p>

        <a href="#" class="up">Go UP</a>

    </footer>

</section> <!-- Closing the #page section -->
</body>
</html>
