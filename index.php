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
$_GET['series'] = 'title';
$_GET['films'] = 'title';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <title>netland</title>
    <meta charset="UTF-8">
</head>

<body>
    <h2 class="titel">Series</h2><br>
    <div class="series">
        <div class="serietitel">
            <a href="index.php?series=title&films=title">
                <h4>Title</h4>
            </a>
            <span class="serietitels">
                <?php
                $stmt = $pdo->query("SELECT title FROM series ORDER BY " . $_GET['series']);
                foreach ($stmt as $row) {
                    echo "" . $row['title'] . "<br>";
                }
                ?>
            </span>
        </div>
        <div class="serierating">
            <a href="index.php?series=rating&films=duur">
                <h4>Rating</h4>
            </a>
            <?php
            $stmt = $pdo->query("SELECT rating FROM series ORDER BY " . $_GET['series']);
            foreach ($stmt as $row) {
                echo "" . $row['rating'] . "<br>";
            }
            ?>
        </div>
        <div class="serierating">
            <h4>Details</h4>
            <?php
            $stmt = $pdo->query("SELECT id FROM series ORDER BY " . $_GET['series']);
            foreach ($stmt as $row) {
                echo "<a href='series.php?id=" . $row['id'] . "'> Bekijk details </a><br>";
            }
            ?>
        </div>
        <div class="serierating">
            <h4>Aanpassen</h4>
            <?php
            $stmt = $pdo->query("SELECT id FROM series ORDER BY " . $_GET['series']);
            foreach ($stmt as $row) {
                echo "<a href='editseries.php?id=" . $row['id'] . "'> Bekijk details </a><br>";
            }
            ?>
        </div>
    </div>
    <div class="middenstuk">
    </div>
    <h2 class="titel">Films</h2><br>
    <div class="films">
        <div class="filmtitel">
            <a href="index.php?series=title&films=title">
                <h4>Title</h4>
            </a>
            <span class="filmtitels">
                <?php
                $stmt = $pdo->query("SELECT title FROM movies ORDER BY " . $_GET['films']);
                foreach ($stmt as $row) {
                    echo "" . $row['title'] . "<br>";
                }
                ?>
            </span>
        </div>
        <div class="filmduur">
            <a href="index.php?series=rating&films=duur">
                <h4>Duur</h4>
            </a>
            <?php
            $stmt = $pdo->query("SELECT duur FROM movies ORDER BY " . $_GET['films']);
            foreach ($stmt as $row) {
                echo "" . $row['duur'] . "<br>";
            }
            ?>
        </div>
        <div class="serierating">
            <h4>Details</h4>
            <?php
            $stmt = $pdo->query("SELECT id FROM movies ORDER BY " . $_GET['films']);
            foreach ($stmt as $row) {
                echo "<a href='films.php?id=" . $row['id'] . "'> Bekijk details </a><br>";
            }
            ?>
        </div>
        <div class="serierating">
            <h4>Aanpassen</h4>
            <?php
            $stmt = $pdo->query("SELECT id FROM movies ORDER BY " . $_GET['films']);
            foreach ($stmt as $row) {
                echo "<a href='editfilms.php?id=" . $row['id'] . "'> Bekijk details </a><br>";
            }
            ?>
        </div>
</body>

</html>