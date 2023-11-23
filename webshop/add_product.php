<?php
$pageTitle = "Produkt hinzufügen";
require_once('header.php');
require_once("dbcon.php");
?>

<!-- name preis desc pic user_id -->

<form method="POST">
Name des neuen Produkts: <input type="text" name="name" id="name"><br>
Preis des neuen Produkts: <input type="text" name="price" id="price"><br>
Beschreibung des Produkts: <textarea name="desc" id="desc" cols="30" rows="10">Produktbeschreibung</textarea>
Bildpfad des Produkts: <input type="text" name="pic" id="pic">
<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
<button type="submit">Produkt hinzufügen</button>
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
$name= $_POST['name'];
$price= $_POST['price'];
$desc= $_POST['desc'];
$pic= $_POST['pic'];
$user_id = $_POST['user_id'];

//PPER

$sql = 'INSERT INTO products (name, price, description, picture, user_id) VALUES (?, ?, ?, ?, ?)';
$stmt = $dbcon->prepare($sql);

$stmt->bind_param('sdssi', $name, $price, $desc, $pic, $user_id);
$stmt->execute();


if($stmt->affected_rows > 0){
    echo "Hinzufügen erfolgreich!";
}else "Fehler beim Hinzufügen";
}




?>





