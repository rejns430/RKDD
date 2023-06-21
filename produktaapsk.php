<?php include('header1.php') ?>
<?php
require("php/connect_db.php");

if (isset($_GET['produkts_ID'])) {
    $produkts_ID = $_GET['produkts_ID'];

    $query = "SELECT * FROM produkts WHERE produkts_ID = $produkts_ID";
    $result = mysqli_query($savienojums, $query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($savienojums));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nosaukums = $row['nosaukums'];
        $cena = $row['cena'];
        $apraksts = $row['apraksts'];
        $bilde = base64_encode($row['bilde']);
        $euro_cena = round($cena * 0.85, 2);
    } else {
        echo "Produkts nav atrasts!";
        exit;
    }
} else {
    echo "Produkts nav norādīts!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkta Apskats</title>
    <link rel="stylesheet" href="produkta.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <div class="main" role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="product-container">
                        <img src="data:image/jpeg;base64,<?php echo $bilde; ?>" alt="<?php echo $nosaukums; ?>"
                            class="product-image">
                        <h2 class="product-name"><?php echo $nosaukums; ?></h2>
                        <h2 class="product-price"><?php echo $euro_cena; ?> €</h2>
                        <p class="product-description"><?php echo $apraksts; ?></p>
                        <a href="grozs.php?produkts_ID=<?php echo $produkts_ID; ?>" class="buy-button">Pirkt</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer1.php'); ?>
</body>

</html>
