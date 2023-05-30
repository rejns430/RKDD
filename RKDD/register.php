<?php
require("php/connect_db.php");

$join = "SELECT klienti.klientiID, klienti.vards, klienti.uzvards, klienti.epasts, klienti.parole, klienti.adresse, lietotajs.lietotajvards 
         FROM klienti 
         INNER JOIN lietotajs 
         ON klienti.klientiID = lietotajs.lietotajsID";

if (isset($_POST['submit'])) {
    // Saņemt un attīrīt datus no formas
    $name = filter_var($_POST['vards'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['uzvards'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['lietotajvards'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['adresse'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['epasts'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['parole'], FILTER_SANITIZE_STRING);

    // Pārbauda vai nav vienādi e-past un lietotajvardi
    $query = "SELECT * FROM klienti WHERE epasts = '$email' OR parole = '$username'";
    $result = mysqli_query($savienojums, $query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        // Paziņo ka epasts vai lietotajvards ir aiznemti
        $message = '<b>Lietotājvārds vai e-pasts jau ir aizņemts.';
    } else {
        // Nohasho paroli
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Ievietot datus 'lietotajs' tabulā
        $query = "INSERT INTO lietotajs (lietotajvards, parole) VALUES ('$username', '$hashed_password')";
        $result = mysqli_query($savienojums, $query);

        // Ievietot datus 'klienti' tabulā
        $query = "INSERT INTO klienti (vards, uzvards, epasts, parole, adresse) VALUES ('$name', '$surname', '$email', '$hashed_password', '$address')";
        $result = mysqli_query($savienojums, $query);

        if ($result) {
            $message = 'Veiksmīgi reģistrējies';
        } else {
            $message = 'Nesanāca reģistrēt lietotāju';
        }
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Reģistrācijas lapa</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  </head>
  <body>
    <div class="container">
      <h1>Reģistrācija</h1>
      <form method="post">
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
        <label for="epasts">Adrese:</label>
        <input type="text" id="address" name="adresse" required>
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
            <td>
              <?php
                if (isset($message)) {
                    echo $message;
                }
              ?>
            </td>
          </tr>
          <tr>
            <td>Tev ir tiesības atteikties no mārketinga paziņojumu saņemšanas un, ja esi piekritis tos saņemt, Tev būs iespēja atteikties - kādā no mūsu saņemtajiem e-pastiem vai rakstot uz info.rkdd@rkdd.lv.
              Lūdzu, atzīmē variantu(-s), kas atbilst Tev:</td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
