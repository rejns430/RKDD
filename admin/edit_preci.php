<?php
include('adminheader.php');
require("../php/connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nosaukums = $_POST["nosaukums"];
    $apraksts = $_POST["apraksts"];
    $cena = $_POST["cena"];
    $veids = $_POST["veids"];
    $bilde = $_FILES["image"];

    $mērķaDirektorija = "admin/preccesbildes"; // Saglabā attēlus attēla mapiņā
    $mērķaFails = $mērķaDirektorija . basename($bilde["name"]);

    // Pārbauda, vai ir augšupielādēts attēls
    if (!empty($bilde["tmp_name"])) {
        // Enkodo attēlus base64
        $base64Image = base64_encode(file_get_contents($bilde["tmp_name"]));

        // Atjauno datubāzi
        $updateSql = "UPDATE produkts SET nosaukums = '$nosaukums', apraksts = '$apraksts', cena = '$cena', bilde = '$base64Image' WHERE produkts_ID = '$id'";
        if (mysqli_query($savienojums, $updateSql)) {
            echo "Prece veiksmīgi labota.";
        } else {
            echo "Atvainojiet, radās problēma, labojot preci: " . mysqli_error($savienojums);
        }
    } else {
        // Atjauno datubāzi bez attēla
        $updateSql = "UPDATE produkts SET nosaukums = '$nosaukums', apraksts = '$apraksts', cena = '$cena' WHERE produkts_ID = '$id'";
        if (mysqli_query($savienojums, $updateSql)) {
            echo "Prece veiksmīgi labota.";
        } else {
            echo "Atvainojiet, radās problēma, labojot preci: " . mysqli_error($savienojums);
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM produkts WHERE produkts_ID = '$id'";
    $result = mysqli_query($savienojums, $sql);
    $row = mysqli_fetch_assoc($result);
    $nosaukums = $row['nosaukums'];
    $apraksts = $row['apraksts'];
    $cena = $row['cena'];
    echo '
        <div class="container">
            <h2>Labot preci</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="id" value="' . $id . '">
                <div class="form-group">
                    <label for="nosaukums">Nosaukums:</label>
                    <input type="text" class="form-control" name="nosaukums" value="' . $nosaukums . '" required>
                </div>
                <div class="form-group">
                    <label for="apraksts">Apraksts:</label>
                    <textarea class="form-control" name="apraksts" required>' . $apraksts . '</textarea>
                </div>
                <div class="form-group">
                    <label for="cena">Cena:</label>
                    <input type="number" class="form-control" name="cena" value="' . $cena . '" required>
                </div>
                <div class="form-group">
                    <label for="image">Attēls:</label>
                    <input type="file" class="form-control-file" name="image" accept="image/*">
                </div>
                <div class="form-group">
                    <img src="data:image/jpeg;base64,' . base64_encode($row['bilde']) . '" alt="Attēls" width="200">
                </div>
                <button type="submit" class="btn btn-primary">Labot</button>
            </form>
        </div>
    ';
}

?>