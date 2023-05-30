<?php include('header1.php'); ?>
<?php
$produkts=$_GET["produkts_ID"];
require("php/connect_db.php");
$join = "SELECT produkts.produkts_ID, nosaukums, bilde, cena, summa, kategorijasvards
FROM produkts
INNER JOIN kategorijas
ON produkts.produkts_ID = kategorijas.kategorijaID
WHERE produkts.produkts_ID=$produkts";
$result = mysqli_query($savienojums, $join);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="grozs.css">
    <style>
        .white-text {
            color: white;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="white-text">Nosaukums</th>
                <th class="white-text">Bilde</th>
                <th class="white-text">Cena</th>
                <th class="white-text">Summa</th>
                <th class="white-text">Kategorija</th>
                <th class="white-text">Darbība</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $bilde = base64_encode($row['bilde']);
                    echo "<tr>";
                    echo "<td class='white-text'>" . $row["nosaukums"] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64,".$bilde."'height=300 width=250'></td>";
                    echo "<td class='white-text'>" . $row["cena"] . "</td>";
                    echo "<td class='white-text'>" . $row["summa"] . "</td>";
                    echo "<td class='white-text'>" . $row["kategorijasvards"] . "</td>";
                    echo "<td><a href='iznemt_grozs.php?id=" . $row["produkts_ID"] . "'>Iznemt</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nav neviena produkta</td></tr>";
            }
            mysqli_close($savienojums);
            ?>
        </tbody>
    </table>
</body>
</html>
<?php include('footer1.php'); ?>
