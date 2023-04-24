 <?php
require("php/connect_db.php");
$join = "SELECT nosaukums, bilde, kategorijasvards, kategorijasveids
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
        <h1>RKDD</h1>
        <a href="grozs.html" class="grozs"><span>&#x1f6d2;</span></a>
    </header>
    
    <main>
         <section class='product-grid'>
            
            <?php
        while ($row = mysqli_fetch_assoc($result)) {
         $nosaukums = $row['nosaukums'];
         $bilde = base64_encode($row['bilde']);
        echo"<div class='product'>";
        echo "<img src='data:image/jpeg;base64,".$bilde." 'height=300 width=250'>";
        echo"<div>";
    }
     ?>
        </div>
        </section>
    </main>

    <footer>
        <p>&copy;RKDD
        </p>
    </footer>
    
</body>
</html>