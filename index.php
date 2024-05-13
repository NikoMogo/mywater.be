<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWater Website</title>
</head>

<body>
    <h1>MyWater.be</h1>
    <form action="index.php" method="GET">
        <input type="text" name="filter_price" />
        <button>GO</button>
    </form>
    <?php
    $host = 'localhost';
    $db   = 'mywater';
    $user = 'mywater';
    $pass = 'e7tkaM[4jbaM10b8';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
    //var_dump ($pdo);

    $query = 'SELECT * FROM `product`';

    var_dump($_GET);
    if (isset($_GET['filter_price'])) {
        $price = $_GET['filter_price'];
        $query = $query . ' WHERE `price` >= ' . $price;
    }
    var_dump($query);
    $stmt = $pdo->query($query);
    //var_dump($stmt);
    echo '<ul>';
    while ($row = $stmt->fetch()) {
        echo '<li>' . $row['label'] . ' pour ' . $row['price'] .  '&euro;</li>';
    }
    echo '</ul>';
    ?>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> MyWater.be</p>
    </footer>
</body>

</html>