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

<?php //izveidoju rediģēt opciju
require("../php/connect_db.php");
if (isset($_POST['save'])) {
        $klienti_id = $_POST['klientiID'];
		$vards = $_POST['Vards'];
		$uzvards = $_POST['Uzvards'];
		$perskods = $_POST['Personaskods'];
		$talr = $_POST['Talrunis'];
		$epasts = $_POST['Epasts'];
        $rediget_sql = "UPDATE  klienti SET klientiID='$klienti_id', Vards='$vards', Uzvards='$uzvards', Personaskods='$perskods', Talrunis='$talr', Epasts='$epasts' where klientiID = '$klienti_id'";

		if (mysqli_query($savienojums, $rediget_sql)){
            echo"<div class='pazinojums zals'>Rediģēšana izdevusies veiksmīgi!</div>";
            header("Refresh:2; url=klienti.php");
        } else{
        echo "<div class='pazinojums sarkans'>Rediģēšana neizdevās!</div>";
        header("Refresh:2; url=klienti.php"); 
        }
	}
    ?>

<footer>
    Reinis Ķēde&copy; 2022
</footer>

<script src="files/script.js"></script>
</body>
</html>