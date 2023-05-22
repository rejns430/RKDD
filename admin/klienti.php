<?php include('../header1.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../admincss/klienti.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>RKDD</title>

</head>

<body class="bg-light">
    <div class="apkart">
        <div class="container">
            <h2>Klientu dati</h2>
            <table class="table table-striped">
                <div class="head-info"></div>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>E-pasts</th>
                        <th>Redigēšana</th>
                        <th>Dzēšana</th>
                    </tr>

                    <?php
     require("../php/connect_db.php"); 
      $klientus_SQL = "SELECT * FROM klienti ORDER BY klientiID DESC";
      $atlasa_klientus = mysqli_query($savienojums, $klientus_SQL) or die ("Nekorekts vaicājums");

      if(mysqli_num_rows($atlasa_klientus) >0){
          while($row = mysqli_fetch_assoc($atlasa_klientus)){
              echo "
                  <tr>
                      <td>{$row['klientiID']}</td>
                      <td>{$row['vards']}</td>
                      <td>{$row['uzvards']}</td>
                      <td>{$row['epasts']}</td>
                      
                      <td><a href='indexedit.php?edit={$row['klientiID']}' class='btn btn-primary'>Rediģēt</a></td>
                      <td><a href='delete.php?delete={$row['klientiID']}&redirect=klienti.php' class='btn btn-danger'>Dzēst</a></td>


                     
                  </tr>                               
              ";
          }
      }else{
          echo "Tabula nav datu ko attēlot";
      }
  ?>
                </table>
            </table>
        </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
<?php include('../footer1.php'); ?>