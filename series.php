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
    <title>netland - Series</title>
    <meta charset="UTF-8">
</head>

<body>
    <a href="index.php">Terug</a>
    <?php
    $stmt = $pdo->query("SELECT * FROM series WHERE id = " . $_GET['id']);

    foreach ($stmt as $row) {
        if ($row['has_won_awards'] == 1) {
            $awards = "Ja";
        } else {
            $awards = "Nee";
        }
        echo "<h1>" . $row['title'] . " - " . $row['rating'] . "</h1><br>";
        echo "<h5> Awards? </h5>" . $awards;
        echo "<h5> Seasons </h5>" . $row['seasons'];
        echo "<h5> Country </h5>" . $row['country'];
        echo "<h5> Language </h5>" . $row['language'] . "<br><br>";
        echo $row['description'];
    }
    ?>
</body>

</html>