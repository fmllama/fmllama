<?php
require_once('dbcon.php');

$post_id = $_POST['ID'];
$title = $_POST['title'];
$content = $_POST['content'];


$sql = 'UPDATE posts SET title = ?, content = ? WHERE ID = ?';
$stmt = $dbcon->prepare($sql);

if($stmt){
    $stmt->bind_param('ssi', $title, $content, $post_id);
    $stmt->execute();

    $stmt->close();
    header('Location: blog.php');
    exit;
} else {
    echo 'SQL-Fehler';
}


?>