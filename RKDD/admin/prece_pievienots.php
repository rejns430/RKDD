<?php
include('adminheader.php');
require("../php/connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iegūst formas datus
    $nosaukums = $_POST["nosaukums"];
    $apraksts = $_POST["apraksts"];
    $cena = $_POST["cena"];
    $veids = $_POST["veids"];
    $bilde = $_FILES["image"];

    // Apstrādā attēla failu
    $mērķaDirektorija = "attēli"; // Saglabā attēlu mapītē
    $mērķaFails = $mērķaDirektorija . basename($bilde["name"]);

    // Pārvieto augšupielādēto attēla failu uz mērķa direktoriju
    if (move_uploaded_file($bilde["tmp_name"], $mērķaFails)) {
        // Veicam datu ievadīšanu datu bāzē ar iegūtajiem datiem
        $sql = "INSERT INTO produkts (nosaukums, apraksts, cena, veids, bilde) VALUES ('$nosaukums', '$apraksts', '$cena', '$veids', '$mērķaFails')";
        if (mysqli_query($savienojums, $sql)) {
            // Prece veiksmīgi pievienota
            echo '<div class="alert alert-success" role="alert">
                    Prece veiksmīgi pievienota!
                  </div>';

            // Redirect to edit_preci.php after 2 seconds
            echo '<script>setTimeout(function() { window.location = "adminprece.php"; }, 2000);</script>';
        } else {
            // Radās problēma, pievienojot preci datu bāzei
            echo '<div class="alert alert-danger" role="alert">
                    Atvainojiet, radās problēma, pievienojot preci datu bāzei: ' . mysqli_error($savienojums) . '
                  </div>';
        }
    } else {
        // Radās problēma, augšupielādējot attēlu
        echo '<div class="alert alert-danger" role="alert">
                Atvainojiet, radās problēma, augšupielādējot attēlu.
              </div>';
    }
}
?>
