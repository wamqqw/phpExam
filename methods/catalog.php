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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;

    $sql = "SELECT City.name, City.country, Forecast.min_temp, Forecast.max_temp, Forecast.days, Forecast.feels_like, Forecast.wind 
            FROM City 
            LEFT JOIN Forecast ON City.id = Forecast.city_id";

    if ($category === 'popular') {
        $sql .= " WHERE City.id IN (SELECT city_id FROM Favorites)";
    } elseif ($category === 'country') {
        $country = isset($_GET['country']) ? $_GET['country'] : null;
        $sql .= " WHERE (:country IS NULL OR City.country = :country)";
    }

    if ($search) {
        $sql .= " AND City.name LIKE :search";
    }

    $stmt = $pdo->prepare($sql);

    if ($category === 'country') {
        $stmt->bindParam(':country', $country);
    }

    if ($search) {
        $searchParam = "%$search%";
        $stmt->bindParam(':search', $searchParam);
    }

    $stmt->execute();
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$cities) {
        echo "No data retrieved!";
    } else {
        header('Content-Type: application/json'); 
        echo json_encode($cities);
    }
}
?>
