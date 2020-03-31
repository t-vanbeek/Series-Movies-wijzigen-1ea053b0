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
    $rating = $_POST['rating'];
    
    $seasons = $_POST['seasons'];
    $desc = $_POST['description'];
    $country = $_POST['country'];
    $lang = $_POST['language'];
    $sql = 'UPDATE series SET title=?, rating=?, seasons=?, description=?, has_won_awards=?, country=?, language=? WHERE id=?';
    $run = $pdo->prepare($sql);
    $run->execute([$newTitle, $rating, $seasons, $desc, $award, $country, $lang, $_GET['id']]);
}
$stmt = $pdo->query("SELECT * FROM series WHERE id = " . $_GET['id']);
foreach ($stmt as $row) {
    $title = $row['title'];
    $ratings = $row['rating'];
    $season = $row['seasons'];
    $descrip = $row['description'];
    $awards = $row['has_won_awards'];
    $countr = $row['country'];
    $language = $row['language'];
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
        <h1><?php echo $title . " - " . $ratings ?></h1>
        <form method="POST">
            <label for="title">Titel</label><br>
            <input type="text" id="titel" name="titel" placeholder="Titel" value="<?php echo $title ?>" /><br>
            <label for="rating">Rating</label><br>
            <input type="number" id="rating" name="rating" placeholder="Rating" value="<?php echo $ratings ?>" /><br>
            <label for="seasons">Seasons</label><br>
            <input type="number" id="seasons" name="seasons" placeholder="Seasons" value="<?php echo $season ?>" /><br>
            <label for="award">Awards?</label><br>
            <input type="nummer" id="award" name="award" placeholder="Awards" value="<?php echo $row['has_won_awards'] ?>" /> (1 = ja; 0 = nee) <br>
            <laber for="desc">Description</laber><br>
            <input size="200" type="text" id="desc" name="description" placeholder="Description" value="<?php echo $descrip ?>" /> <br>
            <label for="country">Country</label><br>
            <input type="text" id="country" name="country" placeholder="Country" value="<?php echo $countr ?>" /> <br>
            <label for="lang">Language</label><br>
            <input type="text" id="lang" name="language" placeholder="language" value="<?php echo $language ?>" /><br>
            <input type="submit" id="send" name="Send" value="Send">
        </form>
    </div>

</body>

</html>