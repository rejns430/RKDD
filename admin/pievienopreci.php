<? require("../php/connect_db.php"); ?>

<?if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    // Attela pievienosana
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "atteli/" . $image;

    //Ievieto attelu mapité
    move_uploaded_file($image_tmp, $image_path);
    
    $sql = "INSERT INTO produkts (cena, summa, nosaukums, apraksts, veids, bilde) 
            VALUES ('$price', 0, '$name', '$description', '$type', '$image_path')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "Attēls pievienots!";
    } else {
        echo "Neizdevās pievienot: " . mysqli_error($connection);
    }
}
?>
