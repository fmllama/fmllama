<?php
$pageTitle = "Produktdetails";
require_once('header.php');
require_once("dbcon.php");



$productID = $_GET['productid'];

$sql = 'SELECT * FROM products WHERE id =' . $productID;
$result = $dbcon->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo $row['description'];
        echo $row['price'];

    }
}

$dbcon->close();



?>

    
</body>
</html>