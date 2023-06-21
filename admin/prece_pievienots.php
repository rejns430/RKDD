<?php
include('adminheader.php');
require("../php/connect_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iegūst formas datus
    $nosaukums = $_POST["nosaukums"];
    $apraksts = $_POST["apraksts"];
    $cena = $_POST["cena"];
    $veids = $_POST["veids"];
    $bilde = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $mērķaDirektorija = "attēli"; // Saglabā attēlu mapītē
    $base64Image = 'data:image/' . ';base64,' . base64_encode($bilde);

    // Pārvieto augšupielādēto attēla failu uz mapi
        // Ievada datubázé pievienotas vértibas
        $sql = "INSERT INTO produkts (nosaukums, apraksts, cena, veids, bilde) VALUES ('$nosaukums', '$apraksts', '$cena', '$veids', '$bilde')";
        if (mysqli_query($savienojums, $sql)) {
            // Prece veiksmīgi pievienota
            echo '<div class="alert alert-success" role="alert">
                    Prece veiksmīgi pievienota!
                  </div>';

            // Péc 2 sekundém aizved atpakal uz adminpreci.php
            echo '<script>setTimeout(function() { window.location = "adminprece.php"; }, 2000);</script>';
        } else {
            //Izmet klúdu+kapec nevareja pievienot 
            echo '<div class="alert alert-danger" role="alert">
                    Atvainojiet, radās problēma, pievienojot preci datu bāzei: ' . mysqli_error($savienojums) . '
                  </div>';
        }
    } else {
        // Izmet kludu+kapec 
        echo '<div class="alert alert-danger" role="alert">
                Atvainojiet, radās problēma, augšupielādējot attēlu.
              </div>';
    }

?>
