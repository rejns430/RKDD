<?php include('header1.php') ?>
<?php
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

if (!isset($_SESSION['totalPrice'])) {
    $_SESSION['totalPrice'] = 0;
}

require("php/connect_db.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["produkts_ID"])) {
        $produkts_ID = $_GET["produkts_ID"];

        $query = "SELECT * FROM produkts WHERE produkts_ID = $produkts_ID";
        $result = mysqli_query($savienojums, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($savienojums));
        }

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nosaukums = $row['nosaukums'];
            $cena = $row['cena'];
            $bilde = base64_encode($row['bilde']);

            $_SESSION['basket'][] = $row;
            $_SESSION['totalPrice'] += $cena;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="grozs.css">
    <style>
        .white-text {
            color: white;
        }
        .product-image {
            width: 300px;
            height: 350px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <h1>Grozs</h1>
        <?php if (isset($row)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="white-text">Nosaukums</th>
                        <th class="white-text">Bilde</th>
                        <th class="white-text">Cena</th>
                        <th class="white-text">Darbība</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="white-text"><?php echo $nosaukums; ?></td>
                        <td><img src="data:image/jpeg;base64,<?php echo $bilde; ?>" alt="<?php echo $nosaukums; ?>" class="product-image"></td>
                        <td class="white-text"><?php echo $cena; ?></td>
                        <td><a href="iznemt_grozs.php?produkts_ID=<?php echo $produkts_ID; ?>" class="btn btn-danger">Iznemt</a></td>
                        <td><a href="iznemt_grozs.php?produkts_ID=<?php echo $produkts_ID; ?>" class="btn btn-">Pirkt</a></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <p style="text-align: center;">Nav neviena produkta</p>
        <?php endif; ?>
    </div>
</body>

</html>
<?php include('footer1.php'); ?>