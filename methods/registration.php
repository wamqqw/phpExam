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
    $name = $_POST['name'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    if ($password !== $confirmPassword) {
        $message = "Passwords do not match!";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM User WHERE email = :email OR login = :login");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($existingUser) {
            $message = "An account with this email or username already exists!";
        } else {
            $insertStmt = $pdo->prepare("INSERT INTO User (name, login, email, password) VALUES (:name, :login, :email, :password)");
            $insertStmt->bindParam(':name', $name);
            $insertStmt->bindParam(':login', $login);
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':password', $password);
            $insertStmt->execute();
            $message = "Registration successful!";
            header("Location: login.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <p class="error-message"><?php echo $message; ?></p>
        <form action="registration.php" method="post" class="registration-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br><br>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br><br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <br><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

