<?php
include('adminheader.php');
require("../php/connect_db.php");

// Retrieve klienti_ID from klienti table
$query_klienti = "SELECT klientiID FROM klienti";
$result_klienti = mysqli_query($savienojums, $query_klienti);
$total_klienti = mysqli_num_rows($result_klienti);

// Retrieve produkts_ID from produkts table
$query_produkts = "SELECT produkts_ID FROM produkts";
$result_produkts = mysqli_query($savienojums, $query_produkts);
$total_produkts = mysqli_num_rows($result_produkts);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">

    <style>
      .circle-badge {
        display: inline-block;
        padding: 0.5em 1em;
        border-radius: 50%;
      }
    </style>
  </head>
  <body>
    <!-- Display the number of clients and products -->
    <div class="container">
      <h1>Admin Dashboard</h1>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Number of Clients</h5>
          <p class="card-text">
            <span class="circle-badge badge badge-primary badge-pill"><?php echo $total_klienti; ?></span>
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Number of Products</h5>
          <p class="card-text">
            <span class="circle-badge badge badge-primary badge-pill"><?php echo $total_produkts; ?></span>
          </p>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
  </body>
</html>
