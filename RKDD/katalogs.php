<?php include('header1.php'); ?>
<?php
require("php/connect_db.php");

$lowerPrice = "";
$upperPrice = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lowerPrice = $_POST["lower_price"];
    $upperPrice = $_POST["upper_price"];
}

$query = "SELECT * FROM produkts";

// Add price filter conditions if the values are provided
if (!empty($lowerPrice) && !empty($upperPrice)) {
    $query .= " WHERE cena BETWEEN $lowerPrice AND $upperPrice";
}

$result = mysqli_query($savienojums, $query);

if (!$result) {
    die('Query failed: ' . mysqli_error($savienojums));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="veikalacss/veikals.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .product {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            height: 100%;
        }

        .product img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .product h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product .btn {
            width: 100%;
        }
    </style>
</head>

<body class="bg-secondary">
    <!-- Sākas lapa -->
    <div class="main" role="main">
        <section class="hero">
            <div class="hero-content text-center">
                <h1>Katalogs</h1>
                <p>Visas preces, kas ir pieejamas noliktavā</p>
            </div>
        </section>
        <div class="container-filter">
            <div class="row">
                <div class="col-md-4">
                    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="mb-3">
                            <label for="lower_price" class="form-label">Min Price</label>
                            <input type="number" name="lower_price" id="lower_price" class="form-control" value="<?php echo $lowerPrice; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="upper_price" class="form-label">Max Price</label>
                            <input type="number" name="upper_price" id="upper_price" class="form-control" value="<?php echo $upperPrice; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="col-md-8">
                <div class="row">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nosaukums = $row['nosaukums'];
            $bilde = base64_encode($row['bilde']);
            $cena = $row['cena'];
            $produkts_ID = $row['produkts_ID'];
            $euro_cena = round($cena * 0.85, 2);
            ?>
            <div class="col-md-4">
                <div class="product">
                    <img src="data:image/jpeg;base64,<?php echo $bilde; ?>" alt="<?php echo $nosaukums; ?>" class="product-image">
                    <h2 class="product-name"><?php echo $nosaukums; ?></h2>
                    <h2 class="product-price"><?php echo $euro_cena; ?> €</h2>
                    <a href="grozs.php?produkts_ID=<?php echo $produkts_ID; ?>" class="btn btn-primary">Pievienot grozam</a>
                </div>
            </div>
    <?php
        }
    } else {
        echo "Pašlaik nav neviena produkta!";
    }
    ?>
</div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer1.php'); ?>
</body>

</html>
