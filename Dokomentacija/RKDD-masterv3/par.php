<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

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