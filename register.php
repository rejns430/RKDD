<?php
require("php/connect_db.php");

$join = "SELECT klienti.vards, klienti.uzvards, klienti.epasts, klienti.adrese, lietotajs.lietotajvards 
            FROM klienti 
            INNER JOIN lietotajs 
            ON klienti.klientiID = lietotajs.lietotajsID";

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['vards'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['uzvards'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['lietotajvards'], FILTER_SANITIZE_STRING);
    $adress = filter_var($_POST['adresse'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['epasts'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['parole'], FILTER_SANITIZE_STRING);

    // Nohasho paroles
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // table Ievieto lietotajus tabula 'lietotaji'
    $query = "INSERT INTO lietotajs (parole) VALUES ('$hashed_password')";
    $result = mysqli_query($savienojums, $query);

    // Insert user into 'klienti' table ievieto lietotajus tabula 'klienti'
    $query = "INSERT INTO klienti (vards, uzvards, epasts, adresse) VALUES ('$name', '$surname', '$email', '$adress')";
    $result = mysqli_query($savienojums, $query);

    if ($result) {
        echo 'Veiksmīgi reģistrējies';
    } else {
        echo 'Nesanāca reģistrēt lietotāju';
    }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  </head>
  <body>
    <div class="container">
      <h1>Reģistrācija</h1>
      <form method = "post">
        <label for="name">Vārds:</label>
        <input type="text" id="name" name="vards" required>
        <br>
        <label for="surname">Uzvārds:</label>
        <input type="text" id="surname" name="uzvards" required>
        <br>
        <label for="surname">Lietotājvārds:</label>
        <input type="text" id="username" name="lietotajvards" required>
        <br>
        <label for="epasts">E-pasts:</label>
        <input type="email" id="email" name="epasts" required>
        <br>
        <label for="epasts">Adresse:</label>
        <input type="text" id="adress" name="adresse" required>
        <br>
        <label for="password">Parole:</label>
        <input type="password" id="password" name="parole" required>
        <br>
        <button type="submit" name="submit">Reģistrēties</button>
      </form>
      <table>
        <thead>
        </thead>
        <tbody>
          <tr>
            <td>Tev ir tiesības atteikties no mārketinga paziņojumu saņemšanas un, ja esi piekritis tos saņemt, Tev būs iespēja atteikties - kādā no mūsu saņemtajiem e-pastiem vai rakstot uz info.rkdd@rkdd.lv.
              Lūdzu, atzīmē variantu(-s), kas atbilst Tev:</td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
 




