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
function dropdown() {
  document.dropdown("filtrs").innerHTML = "Paragraph changed.";
}
</script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RKDD</title>
    <link rel="stylesheet" href="veikalacss/veikals.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Par</a></li>
                <li><a href="#">Apmaksa</a></li>
                <li><a href="piegade.html">Piegāde</a></li>
                <li><a href="#">Kontakti</a></li>
            </ul>
        </nav>
        <div class="search-bar">
    <form action="#">
      <input type="text" placeholder="Meklēt...">
      <button type="submit"><i class="fas fa-search"></i></button>
    </form>
  </div>
        <a class="Pievienoties" href="login1.php">Pievienoties</a>
        <a href="grozs.php" class="grozs"><span>&#x1f6d2;</span></a>
        <h1><a href="veikals.php">RKDD</h1></a>
    </header>
    <form method="POST" action="filter.php">
        <div class="filtrs-conainer">
    <div class="filtrs">
    <label for="filter">Izvēlēties diska/riepas parametrus:</label>
    <select id="filter" name="filter">
    <option value="all">Visi rādiusi</option>
    <?php
    // Izvelk no datubazes radiuss
    if (mysqli_num_rows($result2) > 0) {
        while ($row = mysqli_fetch_assoc($result2)) {
            echo '<option value="' . $row['radiuss'] . '">' . $row['radiuss'] . '</option>';
        }
    }
    ?>
</select>
<select id="filter" name="filter">
<option value="all">Platums</option>
    <?php
    //Izvelk no datubazes platumu
    if (mysqli_num_rows($result3) > 0) {
        while ($row = mysqli_fetch_assoc($result3)) {
            echo '<option value="' . $row['platums'] . '">' . $row['platums'] . '</option>';
            }
    }
    ?>

    </select>
    <select id="filter" name="filter">
<option value="all">Augstums</option>
    <?php
    //Izvelk no datubazes augstumu
    if (mysqli_num_rows($result4) > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            echo '<option value="' . $row['augstums'] . '">' . $row['augstums'] . '</option>';
            }
    }
    ?>
    </select>

    <select id="filter" name="filter">
<option value="all">Ātrums</option>
    <?php
    //Izvelk no datubazes ātrumu
    if (mysqli_num_rows($result5) > 0) {
        while ($row = mysqli_fetch_assoc($result5)) {
            echo '<option value="' . $row['atrums'] . '">' . $row['atrums'] . '</option>';
            }
    }
    ?>
    </select>
    <select id="filter" name="filter">
<option value="all">Skrūves</option>
    <?php
    //Izvelk no datubazes skrūves
    if (mysqli_num_rows($result6) > 0) {
        while ($row = mysqli_fetch_assoc($result6)) {
            echo '<option value="' . $row['skruves'] . '">' . $row['skruves'] . '</option>';
            }
    }
    ?>
    </select>
    <select id="filter" name="filter">
<option value="all">Attālums</option>
    <?php
    //Izvelk no datubazes Skrūvju attālumu
    if (mysqli_num_rows($result7) > 0) {
        while ($row = mysqli_fetch_assoc($result7)) {
            echo '<option value="' . $row['skr_attal'] . '">' . $row['skr_attal'] . '</option>';
            }
    }
    ?>
        </select>
    </div>
</div>


    <button type="submit">Meklēt</button>
    <main>
         <section class='product-grid'>
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
</form>
        </section>
    <footer>
        <p>&copy;RKDD</p>
    </footer>
</body>
</html>