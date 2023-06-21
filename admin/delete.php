<?php
require("../php/connect_db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Table Styling</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<?php if (isset($_GET['delete'])) {
    $klientiID = $_GET['delete'];

    // Izsauc dzēst opciju no datubazes
    $deleteQuery = "DELETE FROM klienti WHERE klientiID = '$klientiID'";

    // Izpilda dzēst funkciju
    if (mysqli_query($savienojums, $deleteQuery)) {
        echo '<div class="container">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="alert alert-success text-center" role="alert">';
        echo 'Dzēšana veiksmīga';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="container">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-md-6">';
        echo '<div class="alert alert-danger text-center" role="alert">';
        echo 'Neizdevās izdzēst lietotāju: ' . mysqli_error($savienojums);
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} ?>

<!--Aizved atpakaļ uz klienti.php pēc 2 sekundēm-->
<?php
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'klienti.php';
echo "<script>setTimeout(function() { window.location.href = '$redirect'; }, 2000);</script>";
?>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>
