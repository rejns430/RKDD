<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Autorizēšanās</title>
  <link rel="stylesheet" href="login1.css">
</head>
<body>
  <div class="logo">
    <img src="atteli/RKDD.png" alt="Logo">
  </div>
  <div class="login-box">
    <h1>Autorizēties</h1>
    <form method="post" action="">
      <?php //Pievieno datubazi
      if(isset($_POST["autorizacija"])){
          require("php/connect_db.php");
          session_start();
          $lietotajvards = mysqli_real_escape_string($savienojums, $_POST["lietotajvards"]);
          $Parole = mysqli_real_escape_string($savienojums, $_POST["parole"]);
          $sqlVaicajums = "SELECT * FROM klienti INNER JOIN lietotajs ON klienti.klientiID = lietotajs.lietotajsID WHERE lietotajvards = '$lietotajvards' ";
          $rezultats = mysqli_query($savienojums, $sqlVaicajums);

          if (mysqli_num_rows($rezultats) == 1){
              while($row = mysqli_fetch_array($rezultats)){
                  if(password_verify($Parole, $row["parole"])){
                      $_SESSION["username"] = $lietotajvards;
                      header("location:test.php");
                  }else{
                      echo "<div class='error'><i class='fas fa-exclamation-circle'></i> Nepareizs lietotājvārds vai parole 1 !</div>";
                  }
              }
          }else{
              echo "<div class='error'><i class='fas fa-exclamation-circle'></i> Nepareizs lietotājvārds vai parole! 2 </div>";
          }
      }

      if(isset($_GET['logout'])){
          session_destroy();
      }
      ?>
      <label for="username">Lietotājvārds</label>
      <input type="text" id="username" name="lietotajvards" placeholder="Ievadi Lietotājvārdu" required>
      <label for="password">Parole</label>
      <input type="password" id="password" name="parole" placeholder="Ievadi Paroli" required>
      <input type="submit" value="Autorizēties" name="autorizacija">
      <li><a href="register.php">Neesi reģistrējies?</a></li>
    </form>
  </div>
</body>
</html>
