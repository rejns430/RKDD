<?php include('adminheader.php')?>
<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKDD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../admincss/klienti.css">
    <link rel="shortcut icon" href="atteli/logo.png" type="image/x-icon">
</head>

<body>
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

		if (mysqli_query($savienojums, $rediget_sql)) {
            echo '<div class="alert alert-success" role="alert">
                    Rediģēšana izdevusies veiksmīgi!
                </div>';
            header("Refresh:2; url=klienti.php");
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Rediģēšana neizdevās!
                </div>';
            header("Refresh:2; url=klienti.php");
        }
	}
    ?>
</body>
</html>