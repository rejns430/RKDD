<?php
require("php/connect_db.php");
$join = "SELECT produkts.produkts_ID, nosaukums, bilde, kategorijasvards, kategorijasveids
FROM produkts
INNER JOIN kategorijas
ON produkts.produkts_ID = kategorijas.kategorijaID";
$result = mysqli_query($savienojums, $join);          
   ?>             
<!DOCTYPE html>
<html lang="en">
<head>
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
        <a class="Pievienoties" href="login1.php">Pievienoties</a>
        <a href="grozs.php" class="grozs"><span>&#x1f6d2;</span></a>
        <h1><a href="veikals.php">RKDD</h1></a>
    </header>
    <form method="POST" action="filter.php">
    <label for="filter">Izvēlēties:</label>
    <select id="filter" name="filter">
        <option value="all">Rādīt visu</option>
        <option value="category1">R16</option>
        <option value="category2">R19</option>
        <option value="category3">R17</option>
        
    </select>
    <button type="submit">Meklēt</button>
    <main>
         <section class='product-grid'>
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
         $nosaukums = $row['nosaukums'];
         $bilde = base64_encode($row['bilde']);
         $produkts_ID = $row['produkts_ID'];
        echo"<div class='product'>";
        echo "<img src='data:image/jpeg;base64,".$bilde."'height=300 width=250'>";
        echo "<h2>".$nosaukums."</h2>";
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