<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../admincss/style_main.css">
    <link rel="shortcut icon" href="../atteli/logotaskbar.png" type="image/x-icon">
</head>
<body class="bg-secondary">
<header>
    <a href="#" class="logo">RKDD</a>
    <nav class="navbar">
        <a href="index.php"><i class="fas fa-users"></i> Klienti</a>
        <a href="maksajumi.php"><i class="fa-sharp fa-solid fa-cash-register"></i></i> Maksājumi</a>
    </nav>
    <nav class="navbar">
        <a href="login.php"><b>Administrators</b> <i class="fas fa-power-off"></i></a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<section id="adminSakums">
    <div class="kopsavilkums">
        <div class="informacija">
                
                <span>
                
                    <?php
                    require("../php/connect_db.php");
                    $klientiKopa= 'SELECT count(klientiID) FROM klienti';
                    $atlasaKlientuSkaitu = mysqli_query($savienojums, $klientiKopa) or die("Nekorekts vaicājums!");

                        if(mysqli_num_rows($atlasaKlientuSkaitu) > 0){
                            while($row = mysqli_fetch_assoc($atlasaKlientuSkaitu)){
                                echo "{$row['count(klientiID)']}";
                            }
                        }
                    ?>
                </span>
                <h3>Visi Klienti</h3>
                <p>Kopš atvēršanās</p>
        </div>
        
    </div>
      
    <div class="row">
        <div class="info">
            <div class="head-info">Pēdējās izmaiņas sistēmā:</div>
            <table>
                <tr>
                    <th>Vārds</th>
                    <th>Uzvārds</th>
                    <th>Adresse</th>
                    <th>Redigēšana</th>
                </tr>
                
                <?php 
                    $klientus_SQL = "SELECT * FROM klienti ORDER BY klientiID DESC";
                    $atlasa_klientus = mysqli_query($savienojums, $klientus_SQL) or die ("Nekorekts vaicājums");

                    if(mysqli_num_rows($atlasa_klientus) >0){
                        while($row = mysqli_fetch_assoc($atlasa_klientus)){
                            echo "

                                <tr>
                                    <th>{$row['vards']}</th>
                                    <th>{$row['uzvards']}</th>
                                    <th>{$row['epasts']}</th>
                                    <td><a href='indexedit.php?edit=<?php echo $row[klientiID] ?>'class='btn' >Edit</a>
				                    </td>
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

<footer class="position-fixes">
    Reinis Ķēde&copy; 2022
</footer>

<script src="files/script.js"></script>
</body>
</html>