<?php
$pageTitle = "Produkte";
require_once('header.php');
require_once("dbcon.php");




$sql = "SELECT * FROM products";
$result = $dbcon->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo '<div class="container">';
        echo '<a href="product_detail.php?productid='.$row['id'].'">' . $row['name'] . '</a>';
        echo '<div><img src="' .$row['picture'] .'" alt="'. $row['description'] .'"></div>';
        echo '</div>';
    }
}else echo ('Kein Produkt gefunden');


$dbcon->close();

?>

</body>
</html>
