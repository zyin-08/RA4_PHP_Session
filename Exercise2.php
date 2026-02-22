<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['inventory'])) {
        $_SESSION['inventory'] = [
            "milk" => 0,
            "soft_drink" => 0
        ];
    }

    if (!isset($_SESSION['worker'])) {
        $_SESSION['worker'] = "";
    }

    if (!empty($_POST['worker'])) {
        $_SESSION['worker'] = htmlspecialchars($_POST['worker']);
    }

    $error = "";

    if (isset($_POST['product']) && isset($_POST['quantity'])) {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        if ($quantity > 0) {
            if (isset($_POST['add'])) {
                $_SESSION['inventory'][$product] += $quantity;
            }

            if (isset($_POST['remove'])) {
                if ($quantity <= $_SESSION['inventory'][$product]) {
                    $_SESSION['inventory'][$product] -= $quantity;
                } else {
                    $error = "Error: You cannot remove more units than available";
                }
            }

        } else {
            $error = "Error: Quantity must be greater than 0";
        }
    }
    ?>

    <h1>Supermarket management</h1>
    <form method="post">
        <label for="worker">Worker name:</label>
        <input type="text" name="worker" required>
        <br><br>

        <label for="product">Choose product:</label><br>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="soft_drink">Soft Drink</option>
        </select>
        <br><br>

        <label for="quantity">Product quantity</label><br>
        <input type="number" name="quantity" min="1" required>
        <br><br>

        <button type="submit" name="add">add</button>
        <button type="submit" name="remove">remove</button>
        <button type="reset" name="reset">reset</button>
    </form>

    <h2>Inventory</h2>
    <p>
        worker: <?php echo $_SESSION['worker']; ?><br>
        units milk: <?php echo $_SESSION['inventory']['milk']; ?><br>
        units soft drink: <?php echo $_SESSION['inventory']['soft_drink']; ?><br>
        <?php echo $error; ?>
    </p>

</body>

</html>