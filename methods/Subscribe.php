<?php
define("HOST", "localhost");
define("DATABASE", "Weather");
define("CHARSET", "utf8");
define("USER", "root");
define("PASSWORD", "");
$message = '';
try {
    $pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE.";charset=".CHARSET, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardNumber = $_POST['card_number'];
    $expiryDate = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];
    $message = "Subscription successfully paid! Access to the service is activated.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="subscribe.css">
</head>
<body>
    <?php if (empty($message)) : ?>
        <form action="Subscribe.php" method="post">
            <h2 align = center>BUY SUBSCRIBE</h2>
            <label for="card_number">Card number:</label>
            <input type="text" id="card_number" name="card_number" maxlength="16" required>
            <br><br>
            <label for="expiry_date">Expiry date:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" maxlength='5' required>
            <br><br>
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required>
            <br><br>
            <button type="submit">Buy Subscription</button>
        </form>
    <?php else : ?>
        <div class="payment-success">
            <h2><?php echo $message; ?></h2>
            <a href="Cities.html" class="return-btn">Go HOME!</a>
        </div>
    <?php endif; ?>
</body>
</html>
