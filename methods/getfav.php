<?php
session_start();

// Подключение к базе данных
define("HOST", "localhost");
define("DATABASE", "Weather");
define("CHARSET", "utf8");
define("USER", "root");
define("PASSWORD", "");

try {
    $pdo = new PDO("mysql:host=".HOST.";dbname=".DATABASE.";charset=".CHARSET, USER, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}

// Обработка запроса на добавление города в избранное
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $cityId = isset($_POST['city_id']) ? $_POST['city_id'] : null;
        $orderNum = isset($_POST['order_num']) ? $_POST['order_num'] : null;

        // Подготовка запроса для добавления города в избранное
        $sql = "INSERT INTO Favorites (user_id, city_id, order_num) VALUES (:user_id, :city_id, :order_num)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':city_id', $cityId);
        $stmt->bindParam(':order_num', $orderNum);

        try {
            $stmt->execute();
            echo "City added to favorites!";
        } catch (PDOException $e) {
            echo "Error adding city to favorites: " . $e->getMessage();
        }
    } else {
        echo "User not logged in!";
    }
}
?>
