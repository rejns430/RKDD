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
		<section class="adminSakums">
	<div class="info">
		<div class="row">
			<div class="head-info2">
			<form method="post" action="indexeditcods.php" >
			<input placeholder = "Klientu ID" type="number" name="klientiID">
			<input placeholder = "Vards" type="text" name="Vards">
			<input placeholder = "Uzvards" type="text" name="Uzvards">
			<input placeholder = "Personaskods" type="text" name="Personaskods">
			<input placeholder = "Talrunis" type="number" name="Talrunis">
			<input placeholder = "Epasts" type="text" name="Epasts">
			<button class="btn" type="submit" name="save" >Saglabat</button>
		</div>
		</div>
	</div>
</div>
	</form>
</section>
</body>
</html>