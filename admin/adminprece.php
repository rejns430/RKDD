<?php
include('adminheader.php');
require("../php/connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $nosaukums = $_POST["nosaukums"];
    $apraksts = $_POST["apraksts"];
    $cena = $_POST["cena"];
    $veids = $_POST["veids"];
    $bilde = addslashes(file_get_contents($_FILES['bilde']['tmp_name']));

    // Process image file
    $mērķaDirektorija = "admin/preccesbildes"; // Saglabá bili mapite
    $mērķaFails = $mērķaDirektorija . basename($bilde["name"]);
    $base64Image = 'data:image/' . $mērķaFails . ';base64,' . base64_encode($bilde);

    // Ieládéto bildi aizved uz mapiti
    if (move_uploaded_file($bilde["tmp_name"], $mērķaFails)) {
        // Nofecho
        $attalumsSql = "SELECT attalums FROM diskapar WHERE nosaukums = '$veids'";
        $attalumsResult = mysqli_query($savienojums, $attalumsSql);
        $attalumsRow = mysqli_fetch_assoc($attalumsResult);
        $attalums = $attalumsRow['attalums'];

        // Nofecho
        $skruvesSql = "SELECT skruves FROM diskapar WHERE nosaukums = '$veids'";
        $skruvesResult = mysqli_query($savienojums, $skruvesSql);
        $skruvesRow = mysqli_fetch_assoc($skruvesResult);
        $skruves = $skruvesRow['skruves'];

        $insertSql = "INSERT INTO produkts (nosaukums, apraksts, cena, veids, skruves, attalums, bilde) VALUES ('$nosaukums', '$apraksts', '$cena', '$veids', '$skruves', '$attalums', '$bilde')";
        if (mysqli_query($savienojums, $insertSql)) {
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'edit_preci.php';
                }, 2000);
            </script>";
            echo "Prece veiksmīgi pievienota.";
            exit; 
        } else {
            echo "Atvainojiet, radās problēma, pievienojot preci datu bāzei: " . mysqli_error($savienojums);
        }
    } else {
        echo "Atvainojiet, radās problēma, augšupielādējot attēlu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preces pārvaldīšana</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container border py-2">
    <h1>Pievienot preci</h1>
    <form action="prece_pievienots.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="nosaukums">Nosaukums:</label>
            <input type="text" class="form-control" name="nosaukums" id="name" required>
        </div>
        <div class="form-group">
            <label for="apraksts">Apraksts:</label>
            <textarea class="form-control" name="apraksts" id="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="cena">Cena:</label>
            <input type="number" class="form-control" name="cena" id="price" required>
        </div>
        <div class="form-group">
    <label for="veids">Veids:</label>
    <select class="form-control" name="veids" id="veids" required>
        <option value="aluminijs">Alumīnijs</option>
        <option value="metals">Metāls</option>
        </select>
        </div>
        <div class="form-group">
    <label for="skruves">Skruves:</label>
    <select class="form-control" name="skruves" id="skruves" required>
        <option value="4">4</option>
        <option value="4">5</option>
        </select>
        </div>
        <div class="form-group">
    <label for="Attalums">Attalums:</label>
    <select class="form-control" name="Attalums" id="Attalums" required>
        <option value="98">98</option>
        <option value="100">100</option>
        <option value="108">108</option>
        <option value="110">110</option>
        <option value="112">112</option>
        <option value="114">114.3</option>
        <option value="115">115</option>
        <option value="120">120</option>
        </select>
        </div>
        <div class="form-group">
            <label for="image">Bilde:</label>
            <input type="file" class="form-control-file" name="image" id="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Pievienot preci</button>
    </form>

    <h1>Pārvaldīt Preces</h1>
    <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nosaukums</th>
            <th>Apraksts</th>
            <th>Cena</th>
            <th>Veids</th>
            <th>Bilde</th>
            <th>Darbības</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Iegūst preces no datu bāzes un izvada tos
        $sql = "SELECT produkts_ID, nosaukums, apraksts, cena, veids, bilde FROM produkts";
        $preces = mysqli_query($savienojums, $sql);
        while ($row = mysqli_fetch_assoc($preces)) {
            $id = $row['produkts_ID'];
            $name = $row['nosaukums'];
            $description = $row['apraksts'];
            $price = $row['cena'];
            $type = $row['veids'];
            $image = base64_encode($row['bilde']);
            ?>

            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $type; ?></td>
                <td><img src="data:image/jpeg;base64,<?php echo $image; ?>" alt="Attēla vienums" width="100" height="100"></td>
                <td>
                    <a href="edit_preci.php?id=<?php echo $id; ?>" class="btn btn-primary">Rediģēt</a>
                    <a href="delete_prece.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Tiešām vēlies dzēst produktu?')">Dzēst</a>
                    <!-- Additional buttons or actions -->
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
