<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php
        require_once('dbcon.php');
        
        $ID = $_GET['id'];

        $sql = "SELECT title FROM journey WHERE ID = $ID";
        $result = $dbcon->query($sql);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $title = $row['title'];
            }
        }

    ?>
    <title>Reisetagebuch <?php echo ($title) ? $title : 'Unterseite' ?></title>                 // ? und : kurz für "if"
</head>
<body>

<h1> <?php echo ($title) ? $title : 'Unterseite'?> </h1>


<?php
//echo $_GET['id'];

$sql = "SELECT * FROM sections";
$result = $dbcon->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo '<div>';
        echo '<h1>' . $row['title'] . '</h1>';
        echo '<p>' . $row['description'] . '</p>'; 

        $sql = 'SELECT * FROM images WHERE ID = '.$row['ID'];
        $res = $dbcon->query($sql);

        if($res->num_rows > 0){
            while($image = $res->fetch_assoc()){
                echo '<img src="images/' . $image['path']. '" . alt = "' . $image['description'] . '" />';

            }
        }
        
        echo '</div>';
    }
}




$dbcon->close();

?>

</body>
</html>