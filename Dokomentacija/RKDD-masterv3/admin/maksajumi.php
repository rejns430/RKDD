<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../admincss/style_main.css">
    <link rel="shortcut icon" href="atteli/logo.png" type="image/x-icon">
</head>
<body>

<header>
    <a href="#" class="logo">RKDD</a>
    <nav class="navbar">
        <a href="index.php"><i class="fas fa-users"></i> Klienti</a>
        <a href="maksajumi.php"><i class="fa-sharp fa-solid fa-cash-register"></i></i> Maksājumi</a>
    </nav>
    <nav class="navbar">
        <a href="login.php"><b>Administrator</b> <i class="fas fa-power-off"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
          
    <div class="row">
        <div class="info">
            <div class="head-info text-center mb-3 text-white bg-secondary">Pēdējie maksājumi:</div>
            <table class="table bg-secondary width: 100rem; bg-secondary">
  <thead>
    <tr class="text-center mb-3 text-white">
      <th scope="col">#</th>
      <th scope="col">Vārds</th>
      <th scope="col">Uzvārds</th>
      <th scope="col">E-pasts</th>
      <th scope="col">Preces nosaukums</th>
      <th scope="col">Cena</th>
    </tr>
  </thead>
</table>
            
                <?php 
                    require("../php/connect_db.php");
                    $pirkumi_sql = "SELECT vards, uzvards, epasts, cena, nosaukums
                    INNER JOIN produkts on piegade INNER JOIN  datums on piegadesID";
                    $pirkumi = mysqli_query($savienojums, $pirkumi_sql) or die ("Nekorekts vaicājums");

                    if(mysqli_num_rows($pirkumi) >0){
                        while($row = mysqli_fetch_assoc($pirkumi)){
                            echo "
                                <tr>
                                    <th>{$row['Vards']}</th>
                                    <th>{$row['Uzvards']}</th>
                                    <th>{$row['E-pasts']}</th>
                                    <th>{$row['Cena']}</th>
                                    <th>{$row['Prece']}</th>
                                    <th>{$row['Nosaukums']}</th>
                                </tr>                               
                            ";
                        }

                    }else{
                        echo "Tabula nav datu ko attēlot";
                    }
                ?>
            </table>
        </div>
        </div>
    </div>
</section>

<footer>
    Reinis Ķēde&copy; 2022
</footer>

<script src="files/script.js"></script>
</body>
</html>