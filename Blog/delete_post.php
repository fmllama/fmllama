<?php
require_once('dbcon.php');
include_once('header.php');

if(isset($_GET['delete_id'])) {
    $post_id = $_GET['delete_id'];
}

$sql = 'DELETE FROM posts WHERE ID = ?';
$stmt = $dbcon->prepare($sql);

if($stmt){
    $stmt->bind_param('i', $post_id);
    $stmt->execute();

    $stmt->close();
    header('Location: blog.php');
    exit;
} else {
    echo 'SQL-Fehler';
}


?>