<?php
$basketCount = isset($_SESSION['basket']) ? count($_SESSION['basket']) : 0;
$totalPrice = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>RKDD</title>
</head>
<body class="dark">

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand mb-0 h1">
            <img class="d-inline-block align-top" src="atteli\logotaskbar.png" width="50" height="50">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="test.php" class="nav-link">
                        Sākums
                    </a>
                </li>
                <li class="nav-item">
                    <a href="katalogs.php" class="nav-link">
                        Katalogs
                    </a>
                </li>
                <li class="nav-item">
                    <a href="par.php" class="nav-link">
                        Par mums
                    </a>
                </li>
                <li class="nav-item">
                    <a href="piegade.php" class="nav-link">
                        Piegāde
                    </a>
                </li>
                <li class="nav-item">
                    <a href="samaksa.php" class="nav-link">
                        Samaksa
                    </a>
                </li>
            </ul>
            <div class="basket">
                <a href="grozs.php">
                <i class="fa fa-shopping-basket"></i>
                <span class="basket-count"><?php echo $basketCount; ?></span>
                    <span class="basket-price"><?php echo "$" . $totalPrice; ?></span>
            </a>
            </div>
            <ul class="navbar-nav mr-2">
                <li class="nav-item">
                    <?php
                    session_start(); // Sāk sesiju
                    if (isset($_SESSION['lietotajvards'])) {
                        $username = $_SESSION['lietotajvards'];
                        echo "<p class='text-white'><span class='font-weight-bold'>$username</span></p>";
                        echo "<div class='bg-danger p-3'><a href='logout.php' class='btn btn-danger'>Atslēgties</a> </div>";
                    } else {
                        echo "<a href='login1.php' class='nav-link'>Pievienoties</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
