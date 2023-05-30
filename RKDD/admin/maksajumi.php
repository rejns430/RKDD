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
            <div class="head-info">Pēdējie maksājumi:</div>
            <table>
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Pakalpojums</th>
                    <th>Cena</th>
                    <th>Prece:</th>
                    <th>Kvalitate:</th>
                </tr>
            
                <?php 
                    require("../php/connect_db.php");
                    
                    $klientus_SQL = "SELECT kl.Vards, kl.Uzvards, ma.Pakalpojums, ma.Cena, ma.beig_dat FROM klienti AS kl INNER JOIN statuss ON kl.klientiID=ID_statuss INNER JOIN masinas_apdr ON ID_statuss=ID_masinas_apdr 
                    INNER JOIN rekins ON ID_masinas_apdr=ID_Rekins INNER JOIN maksajumi AS ma ON ID_Rekins=ma.ID_maksajumi;";
                    $atlasa_klientus = mysqli_query($savienojums, $klientus_SQL) or die ("Nekorekts vaicājums");

                    if(mysqli_num_rows($atlasa_klientus) >0){
                        while($row = mysqli_fetch_assoc($atlasa_klientus)){
                            echo "

                                <tr>
                                    <th>{$row['Vards']}</th>
                                    <th>{$row['Uzvards']}</th>
                                    <th>{$row['Pakalpojums']}</th>
                                    <th>{$row['Cena']}</th>
                                    <th>{$row['beig_dat']}</th>
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