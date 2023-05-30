<? require("../php/connect_db.php"); ?>

<?if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "atteli/" . $image;

    // Move the uploaded image to the desired directory
    move_uploaded_file($image_tmp, $image_path);

    // Insert the item details into the database
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
