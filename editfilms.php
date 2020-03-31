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

if (isset($_POST['Send'])) {
    $award = $_POST['award'];
    if ($award == 0) {
        $award = false;
    } else {
        $award = true;
    }
    $newTitle = $_POST['titel'];
    $rating = $_POST['duur'];
    $seasons = $_POST['date'];
    $desc = $_POST['description'];
    $country = $_POST['country'];
    $sql = 'UPDATE series SET title=?, duur=?, seasons=?, description=?, has_won_awards=?, country=?, language=? WHERE id=?';
    $run = $pdo->prepare($sql);
    $run->execute([$newTitle, $rating, $seasons, $desc, $award, $country, $lang, $_GET['id']]);
}
$stmt = $pdo->query("SELECT * FROM movies WHERE id = " . $_GET['id']);
foreach ($stmt as $row) {
    $title = $row['title'];
    $duur = $row['rating'];
    $datumUitkomst = $row['datum_van_uitkomst'];
    $descrip = $row['description'];
    $land = $row['land_van_herkomst'];
    $ytID = $row['youtube_trailer_id'];
};
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <title>netland - Series</title>
    <meta charset="UTF-8">
</head>

<body>
    <div>
        <a href="index.php?series=title&films=title">Terug</a>
        <h1><?php echo $title . " - " . $duur ?></h1>
        <form method="POST">
            <label for="title">Titel</label><br>
            <input type="text" id="titel" name="titel" placeholder="Titel" value="<?php echo $title ?>" /><br>
            <label for="duur">Duur</label><br>
            <input type="number" id="duur" name="duur" placeholder="Duur" value="<?php echo $duur ?>" /><br>
            <label for="date">Datum van uitkomst:</label><br>
            <input type="date" id="date" name="date" placeholder="Datum" value="<?php echo $date ?>"><br>
            <label for="desc">Description:</label><br>
            <input type="text" id="desc" name="description" placeholder="description" value="<?php echo $descrip ?>"><br>
            <label for="land">Land van uitkomst:</label><br>
            <input type="text"
            <input type="submit" id="send" name="Send" value="Send">
        </form>
    </div>

</body>

</html>