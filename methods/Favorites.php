<?php
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
function addToFavorites($pdo, $user_id, $city_id) {
    $stmt = $pdo->prepare("INSERT INTO Favorites (user_id, city_id) VALUES (:user_id, :city_id)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':city_id', $city_id);
    return $stmt->execute();
}
function getFavorites($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT City.name, City.country, Forecast.min_temp, Forecast.max_temp, Forecast.days, Forecast.feels_like, Forecast.wind 
                           FROM Favorites 
                           JOIN City ON Favorites.city_id = City.id 
                           LEFT JOIN Forecast ON City.id = Forecast.city_id 
                           WHERE Favorites.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
    $city_id = isset($_GET['city_id']) ? $_GET['city_id'] : null;
    if ($user_id !== null && $city_id !== null) {
        addToFavorites($pdo, $user_id, $city_id);
        echo "City added to favorites!";
    }
    if ($user_id !== null) {
        $favorites = getFavorites($pdo, $user_id);
        header('Content-Type: application/json');
        echo json_encode($favorites);
    }
}
?>
