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

    if (!isset($_SESSION['numbers'])) {
        $_SESSION['numbers'] = [10, 20, 30];
    }

    $message = '';
    $average = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['modify'])) {
            $position = $_POST['position'];
            $value = $_POST['value'];

            $_SESSION['numbers'][$position] = $value;
            $message = "Value modified successfully";
        } elseif (isset($_POST['average'])) {

            $sum = array_sum($_SESSION['numbers']);
            $count = count($_SESSION['numbers']);
            $average = "Average: " . round($sum / $count, 2);
        }
    }
    ?>

    <h1>Modify array saved in session</h1>
    <form method="post">
        <label for="position">Position to modify:</label>
        <select name="position" id="position">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <br><br>

        <label for="value">New value:</label>
        <input type="number" name="value">
        <br><br>

        <button type="submit" name="modify">Modify</button>
        <button type="submit" name="average">Average</button>
        <button type="reset" name="reset">Reset</button>
    </form>

    <p>

        Current array:
        <?php echo implode(', ', $_SESSION['numbers']); ?>
        <br>
        <?php echo $message; ?>
        <br>
        <?php echo $average; ?>
    </p>

</body>

</html>