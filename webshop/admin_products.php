
<?php
$pageTitle = "Operationenauswahl für Admin";
require_once('header.php');
require_once("dbcon.php");
?>

<a href="add_product.php">Produkt hinzufügen</a>



<?php
$sql = "SELECT * FROM products";
$result = $dbcon->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo '<div class="container">';
        echo '<a href="edit_product.php?edit_id='.$row['id'].'">' . $row['name'] . ' bearbeiten </a>'; 
        echo '<a href="delete_product.php?delete_id=' .$row['id'] .'">' . $row['name'] . ' löschen </a>'; 
        echo '</div>';
    }
}else echo ('Kein Produkt gefunden');



?>