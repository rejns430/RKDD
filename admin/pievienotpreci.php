<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iegūst formas datus
    $nosaukums = $_POST["nosaukums"];
    $apraksts = $_POST["apraksts"];
    $cena = $_POST["cena"];
    $veids = $_POST["veids"];
    $bilde = $_FILES["bilde"];

    // Apstrādā attēla failu
    $mērķaDirektorija = "attēli/"; // Saglabā attēlu mapītē
    $mērķaFails = $mērķaDirektorija . basename($bilde["name"]);

    // Pārbauda vai ir pareizais formāts
    $augšupielādeOk = 1;
    $attēlaFailaTips = strtolower(pathinfo($mērķaFails, PATHINFO_EXTENSION));
    $atļautieFailuTipi = array("jpg", "jpeg", "png", "gif");

    if (!in_array($attēlaFailaTips, $atļautieFailuTipi)) {
        echo "Atvainojiet, tikai JPG, JPEG, PNG un GIF failu formāti ir atļauti.";
        $augšupielādeOk = 0;
    }

    if ($augšupielādeOk) {
        if (move_uploaded_file($bilde["tmp_name"], $mērķaFails)) {
            echo "Prece veiksmīgi pievienota.";
        } else {
            echo "Atvainojiet, radās problēma, augšupielādējot attēlu.";
        }
    }
}
?>