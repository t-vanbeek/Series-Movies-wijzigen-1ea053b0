<?php
$host = 'localhost';
$db   = 'netland';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <title>netland - Films</title>
    <meta charset="UTF-8">
</head>

<body>
    <a href="index.php">Terug</a>
    <div>
        <?php
        $stmt = $pdo->query("SELECT * FROM movies WHERE id = " . $_GET['id']);

        foreach ($stmt as $row) {
            echo "<h1>" . $row['title'] . " - " . $row['duur'] . " Minuten </h1><br>";
            echo "<h5> Datum van uitkomst </h5>" . $row['datum_van_uitkomst'];
            echo "<h5> Land van uitkomst </h5>" . $row['land_van_uitkomst'];
            echo $row['description'] . "<br><br>";
            echo "<iframe width='420' height='315'
        src='https://www.youtube.com/embed/" . $row['youtube_trailer_id'] . "'>
        </iframe> ";
        }
        ?>
    </div>
</body>

</html>