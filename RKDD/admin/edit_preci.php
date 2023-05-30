<?php
include('adminheader.php');
require("../php/connect_db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST["id"];
    $nosaukums = $_POST["nosaukums"];
    $apraksts = $_POST["apraksts"];
    $cena = $_POST["cena"];
    $veids = $_POST["veids"];
    $bilde = $_FILES["image"];

    // Process image file
    $mērķaDirektorija = "admin/preccesbildes"; // Save images in the "attēli/" folder
    $mērķaFails = $mērķaDirektorija . basename($bilde["name"]);

    // Move the uploaded image file to the destination directory
    if (move_uploaded_file($bilde["tmp_name"], $mērķaFails)) {
        // Fetch attalums from diskapar table
        $attalumsSql = "SELECT attalums FROM diskapar WHERE nosaukums = '$veids'";
        $attalumsResult = mysqli_query($savienojums, $attalumsSql);
        $attalumsRow = mysqli_fetch_assoc($attalumsResult);
        $attalums = $attalumsRow['attalums'];

        // Fetch skruves from diskapar table
        $skruvesSql = "SELECT skruves FROM diskapar WHERE nosaukums = '$veids'";
        $skruvesResult = mysqli_query($savienojums, $skruvesSql);
        $skruvesRow = mysqli_fetch_assoc($skruvesResult);
        $skruves = $skruvesRow['skruves'];

        // Perform database update with the retrieved data
        $updateSql = "UPDATE produkts SET nosaukums = '$nosaukums', apraksts = '$apraksts', cena = '$cena', veids = '$veids', skruves = '$skruves', skr_attal = '$attalums', bilde = '$mērķaFails' WHERE produkts_ID = '$id'";
        if (mysqli_query($savienojums, $updateSql)) {
            echo "Prece veiksmīgi labota.";
        } else {
            echo "Atvainojiet, radās problēma, labojot preci: " . mysqli_error($savienojums);
        }
    } else {
        echo "Atvainojiet, radās problēma, augšupielādējot attēlu.";
    }
}

// Get the ID of the item to edit from the URL parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the item from the database based on the IDy
    $sql = "SELECT * FROM produkts WHERE produkts_ID = '$id'";
    $result = mysqli_query($savienojums, $sql);
    $row = mysqli_fetch_assoc($result);
    $nosaukums = $row['nosaukums'];
    $apraksts = $row['apraksts'];
    $cena = $row['cena'];
    $veids = $row['Veids'];

    // Fetch the skruves and attalums values from diskapar table
    $diskaparSql = "SELECT skruves, skr_attal FROM diskapar INNER JOIN produkts ON diskapar.diskapar_id=produkts.produkts_ID WHERE nosaukums = '$veids'";
    $diskaparResult = mysqli_query($savienojums, $diskaparSql);
    $diskaparRow = mysqli_fetch_assoc($diskaparResult);
    $skruves = $diskaparRow['skruves'];
    $attalums = $diskaparRow['skr_attal'];

    $bilde = $row['bilde'];

    // Fetch the available types from diskapar table
    $veidiSql = "SELECT nosaukums FROM diskapar";
    $veidiResult = mysqli_query($savienojums, $veidiSql);
    $veidiOptions = '';
    while ($veidsRow = mysqli_fetch_assoc($veidiResult)) {
        $selected = ($veidsRow['nosaukums'] == $veids) ? 'selected' : '';
        $veidiOptions .= '<option value="' . $veidsRow['nosaukums'] . '"' . $selected . '>' . $veidsRow['nosaukums'] . '</option>';
    }

    // Display the form to edit the item
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
                    <label for="veids">Veids:</label>
                    <select class="form-control" name="veids" required>
                        ' . $veidiOptions . '
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Attēls:</label>
                    <input type="file" class="form-control-file" name="image" accept="image/*">
                </div>
                <div class="form-group">
                    <img src="../' . $bilde . '" alt="Attēls" width="200">
                </div>
                <div class="form-group">
                    <label for="skruves">Skruves:</label>
                    <input type="text" class="form-control" name="skruves" value="' . $skruves . '" readonly>
                </div>
                <div class="form-group">
                    <label for="skr_attal">Attālums:</label>
                    <input type="text" class="form-control" name="skr_attal" value="' . $attalums . '" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Labot</button>
            </form>
        </div>
    ';
}

?>
