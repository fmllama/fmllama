<?php
$pageTitle = "Operationenauswahl für Admin";
require_once('header.php');
require_once("dbcon.php");

if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
}

$sql = 'DELETE FROM products WHERE id = ?';
$stmt = $dbcon->prepare($sql);

if($stmt){
$stmt->bind_param('i', $delete_id);
$stmt->execute();

$stmt->close();
}else echo "Fehler beim Löschen";

?>


