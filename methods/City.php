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
function getCityForecast($pdo, $cityId) {
    $stmt = $pdo->prepare("SELECT City.name, City.country, Forecast.min_temp, Forecast.max_temp, Forecast.days, Forecast.feels_like, Forecast.wind 
                           FROM City 
                           LEFT JOIN Forecast ON City.id = Forecast.city_id 
                           WHERE City.id = :cityId");

    $stmt->bindParam(':cityId', $cityId);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cityId = isset($_GET['city_id']) ? $_GET['city_id'] : null;

    if ($cityId !== null) {
        $cityForecast = getCityForecast($pdo, $cityId);
        header('Content-Type: application/json');
        echo json_encode($cityForecast);
    }
}
?>