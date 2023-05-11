<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ielogošanās sistēmā</title>
    <link rel="stylesheet" href="../admincss/style_login.css">
    <link rel="shortcut icon" href="../atteli/logotaskbar.png" type="image/x-icon">
</head>
<body>
	<div class="container" id="container">
		<div class="form-container sign-in-container">
		<form name='form-login' method='post'>
				<img class="logo" src="../atteli/logotaskbar.png">
				<h1>Ielogoties sistēmā</h1>
				<input type="text" name="lietotajs" placeholder="Lietotājvārds"/> 
				<input type="password" name="Parole" placeholder="Parole" />
				<input type="submit" name="autorizacija" value="Ielogoties">

        <?php //Pievieno datubazi
          if(isset($_POST["autorizacija"])){
            require("../php/connect_db.php");
            session_start();

            $lietotajvards = mysqli_real_escape_string($savienojums, $_POST["lietotajs"]);
            $Parole = mysqli_real_escape_string($savienojums, $_POST["Parole"]);
            $sqlVaicajums = "SELECT * FROM lietotajs WHERE lietotajs = '$lietotajvards' ";
            $rezultats = mysqli_query($savienojums, $sqlVaicajums);

            if (mysqli_num_rows($rezultats) == 1){
                while($row = mysqli_fetch_array($rezultats)){
                    if(password_verify($Parole, $row["Parole"])){
                        $_SESSION["username"] = $lietotajvards;
                        header("location:index.php");
                    }else{
                        echo "<div class='error'><i class='fas fa-exclamation-circle'></i> Nepareizs lietotājvārds vai parole!</div>";
                    }
                }
            }else{
                echo "<div class='error'><i class='fas fa-exclamation-circle'></i> Nepareizs lietotājvārds vai parole! </div>";
            }
          }

          if(isset($GET['logout'])){
            session_destroy();
          }
        ?>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				
			</div>
		</div>
	</div>
</body>
</html>