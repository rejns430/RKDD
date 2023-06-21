<?php include('adminheader.php') ?>
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

<body class="bg-light">
    <div class="apkart">
        <div class="container">
            <h2>Klientu dati</h2>
            <table class="table table-striped">
                <div class="head-info">Pēdējās izmaiņas sistēmā:</div>
                <table class="table table-bordered">
                    <section class="adminSakums">
                        <div class="info">
                            <div class="row">
                                <div class="head-info2">
                                    <form method="post" action="indexeditcods.php"
                                        style="margin: 0 auto; text-align: center;">
                                        <tr>
                                            <td><input placeholder="Klientu ID" type="number" name="klientiID"></td>
                                        </tr>
                                        <tr>
                                            <td><input placeholder="Vards" type="text" name="Vards"></td>
                                        </tr>
                                        <tr>
                                            <td><input placeholder="Uzvards" type="text" name="Uzvards"></td>
                                        </tr>
                                        <tr>
                                            <td><input placeholder="Personaskods" type="text" name="Personaskods"></td>
                                        </tr>
                                        <tr>
                                            <td><input placeholder="Talrunis" type="number" name="Talrunis"></td>
                                        </tr>
                                        <tr>
                                            <td><input placeholder="Epasts" type="text" name="Epasts"></td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn" type="submit" name="save">Saglabat</button></td>
                                        </tr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </table>
            </table>
        </div>
    </div>

</body>
</html>