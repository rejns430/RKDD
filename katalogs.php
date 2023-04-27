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
    <script>
        
    </script>
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
        <main>
            <section class='product-grid'>
                <div class="site-search-module">
                    <div class="container">
                        <div class="site-search-module-inside">
                            <form action="#">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="propery contract type"
                                                class="form-control input-lg selectpicker">
                                                <label>Riepu augstums</label>
                                                <option selected>Augstums</option>
                                                <?php
                                                //Izvelk no datubazes augstumu
                                                if (mysqli_num_rows($result4) > 0) {
                                                while ($row = mysqli_fetch_assoc($result4)) {
                                               echo '<option value="' . $row['augstums'] . '">' . $row['augstums'] . '</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="propery location" class="form-control input-lg selectpicker">
                                                <option selected>Skrūvju skaits</option>
                                                <?php
                                                //Izvelk no datubazes skrūves
                                                if (mysqli_num_rows($result6) > 0) {
                                                while ($row = mysqli_fetch_assoc($result6)) {
                                                echo '<option value="' . $row['skruves'] . '">' . $row['skruves'] . '</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2"> <button type="submit"
                                                class="btn btn-primary btn-block btn-lg"><i class="fa fa-search"></i>
                                                Meklēt</button> </div>
                                    </div>
                                    <div class="row hidden-xs hidden-sm">
                                        <div class="col-md-2">
                                        <option>Any</option>
                                            <select name="beds" class="form-control input-lg selectpicker">
                                            <?php
                                            // Izvelk no datubazes radiuss
                                            if (mysqli_num_rows($result2) > 0) {
                                            while ($row = mysqli_fetch_assoc($result2)) {
                                            echo '<option value="' . $row['radiuss'] . '">' . $row['radiuss'] . '</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Riepu platums</label>
                                            <select name="beds" class="form-control input-lg selectpicker">
                                                <option>Any</option>
                                                <?php
                                                //Izvelk no datubazes platumu
                                                if (mysqli_num_rows($result3) > 0) {
                                                while ($row = mysqli_fetch_assoc($result3)) {
                                                echo '<option value="' . $row['platums'] . '">' . $row['platums'] . '</option>';
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Skrūvju attālums</label>
                                            <select name="beds" class="form-control input-lg selectpicker">
                                                <?php
                                                //Izvelk no datubazes Skrūvju attālumu
                                                if (mysqli_num_rows($result7) > 0) {
                                                while ($row = mysqli_fetch_assoc($result7)) {
                                                echo '<option value="' . $row['skr_attal'] . '">' . $row['skr_attal'] . '</option>';
                                                    }
                                                }
                                            ?>
        </main>
        </select>
</div>
</div>
</div>
</div>
</form>
<div class="filtrs-conainer">
    <?php
            if (!$result) {
                die('Query failed: ' . mysqli_error($savienojums));
              }
        while ($row = mysqli_fetch_assoc($result)) {
            
         $nosaukums = $row['nosaukums'];
         $bilde = base64_encode($row['bilde']);
         $cena = $row['cena'];
         $produkts_ID = $row['produkts_ID'];
        echo"<div class='product'>";
        echo "<img src='data:image/jpeg;base64,".$bilde."'height=300 width=250'>";
        echo "<h2>".$nosaukums."</h2>";
        echo "<h2>".$cena."</h2>";
        echo "<a href='grozs.php?produkts_ID=".$produkts_ID."' class='pievienot-grozam'>Pievienot grozam</a>";
        echo"</div>";
    }
     ?>
    </div>
</div>