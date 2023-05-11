<?php include('header.php'); ?>
<?php
require("php/connect_db.php");
$join = "SELECT radiuss, platums, augstums, atrums, apraksts, skruves, skr_attal, produkts.produkts_ID, nosaukums, bilde, kategorijasvards, kategorijasveids, cena
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
$result8 = mysqli_query($savienojums, $join);            
   ?>
<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


  </head>
  <body>
  <div class="card" style="width: 40rem;">
 <?php 
 $sql = "SELECT * FROM produkts ORDER BY cena ASC LIMIT 1";
 $result = mysqli_query($savienojums, $sql);
 if (!$result) {
   die('Query failed: ' . mysqli_error($savienojums));
 }
 while ($row = mysqli_fetch_assoc($result)) {
   $nosaukums = $row['nosaukums'];
   $apraksts = $row['apraksts'];
   $bilde = base64_encode($row['bilde']);
   $cena = $row['cena'];
   echo "<div class='text-center'>";
   echo "<a href='apraksts.php'><img disks src='data:image/jpeg;base64,".$bilde."'height=400 width=350'></a>";
   echo "<h2>".$nosaukums."</h2>";
   echo "<p>".$apraksts."</p>"; // Add this line to display the 'apraksts' value
   $euro_cena = round($cena * 0.85, 2); //Pārveido uz eiro
   echo "<h2>".$cena."</h2>";
   echo "<h2>".$euro_cena." €</h2>";
   echo "</div>";
 }
?>
  <div class="card-body">
    <?php
    echo "<h5 class=card-title> <?php echo $apraksts; ?></h5>";
    ?>
    <p class="card-text">JDM disks</p>
    <a href="grozs.php" class="btn btn-primary">Ielikt grozā</a>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  <?php include('footer.php'); ?>
</html>