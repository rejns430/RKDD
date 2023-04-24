<?php
require("php/connect_db.php");
$join = "SELECT produkts.produkts_ID, nosaukums, bilde, kategorijasvards, kategorijasveids, cena, datums
FROM produkts, rekins
INNER JOIN kategorijas
ON produkts.produkts_ID = kategorijas.kategorijaID";
$result = mysqli_query($savienojums, $join);          
   ?> 