<?php include('header.php'); ?>
<?php
require("php/connect_db.php");
$join = "SELECT radiuss, platums, augstums, atrums, skruves, skr_attal, produkts.produkts_ID, nosaukums, bilde, kategorijasvards, kategorijasveids, cena
FROM produkts
INNER JOIN kategorijas
ON produkts.produkts_ID = kategorijas.kategorijaID
INNER JOIN diskapar
ON produkts.produkts_ID = diskapar.diskapar_id";
$result = mysqli_query($savienojums, $join);   
$result2 = mysqli_query($savienojums, $join);
$result3 = mysqli_query($savienojums, $join);   
$result4 = mysqli_query($savienojums, $join);
$result5 = mysqli_query($savienojums, $join);   
$result6 = mysqli_query($savienojums, $join);
$result7 = mysqli_query($savienojums, $join);          
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RKDD</title>
    <link rel="stylesheet" href="veikalacss/veikals.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="bg-secondary">
<div class="main" role="main">
    <section class="hero">
        <div class="hero-content text-center mt-3">
        <h1>Visi jaunumi</h1>
        <p>Izmaiņas un piedāvājumi</p>
    </div>
    </section>
    <form method="POST" action="katalogs.php">
        <div class="container col-md-12">
            <div class="karstakie">
                <div class="container">
                    <div class="virsraksts text-center mb-3 text-white">
                        <h2>Mūsu Lētākie pidāvājumi</h2>
                    </div>
                </div> 
                <div class="container d-flex justify-content-center border border-3 bg-secondary mb-5">
                    <?php
                     $sql = "SELECT * FROM produkts ORDER BY cena ASC LIMIT 2";
                     $result = mysqli_query($savienojums, $sql);
                     if (!$result) {
                       die('Query failed: ' . mysqli_error($savienojums));
                     }
                     while ($row = mysqli_fetch_assoc($result)) {
                       $nosaukums = $row['nosaukums'];
                       $bilde = base64_encode($row['bilde']);
                       $cena = $row['cena'];
                       echo "<div class='text-center'>";
                       echo "<a href='apraksts.php'><img disks src='data:image/jpeg;base64,".$bilde."'height=400 width=350'></a>";
                       echo "<h2>".$nosaukums."</h2>";
                       $euro_cena = round($cena * 0.85, 2); //Pārveido uz eiro
                       echo "<h2>".$euro_cena." €</h2>";
                       echo "</div>";
                     }
                    ?>
                </div>
            </div>
        </form>
        </div>
       <div class="container col-md-12">
        <div class="dargakie">
        <div class="virsraksts text-center mb-3 text-white">
                        <h2>Jaunākās preces</h2>
                    </div>
            <div class="container d-flex justify-content-center border border-3 bg-secondary mb-4">
                    <?php
                     $sql = "SELECT * FROM produkts ORDER BY cena ASC LIMIT 2";
                     $result = mysqli_query($savienojums, $sql);
                     if (!$result) {
                       die('Query failed: ' . mysqli_error($savienojums));
                     }
                     while ($row = mysqli_fetch_assoc($result)) {
                       $nosaukums = $row['nosaukums'];
                       $bilde = base64_encode($row['bilde']);
                       $cena = $row['cena'];
                       echo "<div class='text-center'>";
                       echo "<a href='apraksts.php'><img disks src='data:image/jpeg;base64,".$bilde."'height=400 width=350'></a>";
                       echo "<h2>".$nosaukums."</h2>";
                       $euro_cena = round($cena * 0.85, 2); //Pārveido uz eiro
                       echo "<h2>".$euro_cena." €</h2>";
                       echo "</div>";
                     }
                    ?>
                </div>
            </div>
        </form>
        </div>

            </div>
        </div>
       </div>
    

</div>                                                                                    
</div>
</div>
</body>
<?php include('footer.php'); ?>
</html>

