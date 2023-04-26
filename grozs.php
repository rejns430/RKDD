<?php include('header.php'); ?>
<?php
require("php/connect_db.php");
$join = "SELECT produkts.produkts_ID, nosaukums, bilde, cena, summa, kategorijasvards
FROM produkts
INNER JOIN kategorijas
ON produkts.produkts_ID = kategorijas.kategorijaID";
$result = mysqli_query($savienojums, $join);          
?>             

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="grozs.css">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nosaukums</th>
                <th>Bilde</th>
                <th>Cena</th>
                <th>Summa</th>
                <th>Kategorija</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Saliek produktus un to cenas tabulā
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $bilde = base64_encode($row['bilde']);
                    echo "<tr>";
                    echo "<td>" . $row["nosaukums"] . "</td>";
                    echo "<td><img src='" . $bilde . "'></td>";
                    echo "<td>" . $row["cena"] . "</td>";
                    echo "<td>" . $row["summa"] . "</td>";
                    echo "<td>" . $row["kategorijasvards"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nav neviena produkta</td></tr>";
            }
            mysqli_close($savienojums);
            ?>
        </tbody>
    </table>

</body>
</html>