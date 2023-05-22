<?php
require("../php/connect_db.php");

if (isset($_GET['delete'])) {
    $klientiID = $_GET['delete'];

    // Izsauc dzēst opciju no datubazes
    $deleteQuery = "DELETE FROM klienti WHERE klientiID = '$klientiID'";

    // Izpilda dzēst funkciju
    if (mysqli_query($savienojums, $deleteQuery)) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($savienojums);
    }
}

//Aizved atpakal uz klienti.php pēc 2 sekundēm
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'klienti.php';
echo "<script>setTimeout(function() { window.location.href = '$redirect'; }, 2000);</script>";
?>