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
<!--Sākas lapa-->
<div class="main" role="main">
    <section class="hero">
        <div class="hero-content">
            <h1>Veikals</h1>
            <p>šis lauks nav svarīgs</p>

        </div>
    </section>
    <form method="POST" action="filter.php">
</div>
</div>
</div>
</div>
</form>
    <div class="container col-md-12">
        <div class="karstakie">
            
            <div class="container">
                <div class="virsraksts">
                    <h2>Mūsu Lētākie pidāvājumi</h2>
                </div>
            </div>
        </div> 
        <div class="container">
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
     echo "<img pidars src='data:image/jpeg;base64,".$bilde."'height=300 width=250'>";
     echo "<h2>".$nosaukums."</h2>";
     echo "<h2>".$cena."</h2>";
   }
  ?>
</div>

    
                <div class="row">
                <div class="col-md-12 " id="poga_uz_misenem">
                    <a href="katalogs.php">
                        <button>Apskati visas mūsu piedāvājumus</button>
                    </a>                                                                                         
        </div>
    </div>