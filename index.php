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

        <h1>Cost Calculater</h1>
    </header>

    <div class="line"></div>

    <article id="article1">

        <h3>Input information</h3>

        <div class="line"></div>

        <div class="articleBody clear">

            <section id="response">
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
                    Name: <?= $_POST["name"] ?><br/>
                    Email: <?= $_POST["email"] ?><br/>
                    Website: <?= $_POST["website"] ?><br/>

                    Price: $<span class=\"number\"><?= $_POST["price"] ?></span><br/>
                    Quantity: <span class=\"number\"><?= $_POST["qty"] ?></span><br/>

                    <?php

                    echo "<br />";
                    if ($form->isChosen('percent'))
                        echo "Discount: <span class=\"number\">" . $_POST["disc"] . "</span>%";
                    else
                        echo "Discount: $<span class=\"number\">" . $_POST["disc"] . "</span>";

                    echo "<br />";
                    echo "<br />";

                    if ($_POST["tax"] == 0) {
                        echo "No Tax<br />";
                    } else {
                        echo "Tax: <span class=\"number\">" . $_POST["tax"] . "</span>%<br />";
                    }

                    if ($_POST["shipping"] == 0) {
                        echo "Free Shipping<br />";
                    } else {
                        echo "Shipping cost: $" . $_POST["shipping"] . "<br />";
                    }

                    echo "Payments: <span class=\"number\">" . $_POST["payments"] . "</span><br />";

                    // Determine the tax rate:
                    $taxrate = (int)$_POST["tax"] / 100;
                    $taxrate = $taxrate + 1;

                    // Calculate the total:
                    $total = $_POST["price"] * $_POST["qty"];
                    $total = $total + $_POST["shipping"];

                    if ($form->isChosen('percent'))
                        $total = $total - ($total * $_POST["disc"] / 100);
                    else
                        $total = $total - $_POST["disc"];

                    // Factor in the tax rate:
                    $total = $total * $taxrate;

                    $payments = (int)$_POST["payments"];
                    if ($payments == 0)
                        $payments = 1;
                    // Calculate the monthly payments:
                    $monthly = $total / $payments;

                    echo "<br /><h4>Results</h4>";
                    echo "Total cost: $<span class=\"number\">" . round($total, 2) . "</span>.<br />";

                    if ($payments == 1) {
                        echo "One Payment: $<span class=\"number\">" . round($monthly, 2) . "</span>";
                    } else {
                        echo "<span class=\"number\">" . $payments . "</span> monthly payments: $<span class=\"number\">" . round($monthly, 2) . "</span> each";
                    }
                    echo "</div>";
                    ?>
                    <?php endif; ?>
                    <?php endif; ?>
            </section>

            <form method="post">

                <section>
                    <table border="0" cellpadding="5" cellspacing="5">
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
                                       type="text"
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
                                       type="text"
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
                                       type="text"
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
                                       type="text"
                                       name="tax"
                                       size="3"
                                       value='<?= $form->prefill('tax', '') ?>'/> %
                            </td>
                        </tr>
                        <tr>
                            <td>Shipping method</td>
                            <td>
                                <select name="shipping">
                                    <option value="0.00">N/A or Pickup: Free</option>
                                    <option value="9.95">Standard: 1 Week $9.95</option>
                                    <option value="29.95">Expedite: 2nd day $29.95</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Number of payments</td>
                            <td>
                                <input type='number'
                                       class="rounded"
                                       type="text"
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
                            <td colspan="2" align="right">
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

        <p>Copyright 2017 - p2.mushal.me</p>

        <a href="#" class="up">Go UP</a>

    </footer>

</section> <!-- Closing the #page section -->
</body>
</html>
