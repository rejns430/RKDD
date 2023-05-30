<?php
include('adminheader.php');
require("../php/connect_db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .alert-container {
      margin-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="alert-container">
      <?php
      if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete the product from the database
        $deleteQuery = "DELETE FROM produkts WHERE produkts_ID = '$id'";

        if (mysqli_query($savienojums, $deleteQuery)) {
          // Display a green success alert box
          echo '<div class="alert alert-success" role="alert">Produkts veiksmīgi dzēsts.</div>';

          // Redirect back to adminprece.php after successful deletion
          echo "<script>
            setTimeout(function() {
              window.location.href = 'adminprece.php';
            }, 2000);
          </script>";
          exit; // Stop further execution of the script
        } else {
          // Display a red error alert box
          echo '<div class="alert alert-danger" role="alert">Neizdevās dzēst produktu: ' . mysqli_error($savienojums) . '</div>';
        }
      }
      ?>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
