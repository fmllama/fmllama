<?php
session_start();

include_once("dbcon.php");

$title = $_POST["title"];
$content = $_POST["content"];
$userID = $_SESSION['user_id'];

$sql = "INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)";
$stmt = $dbcon->prepare($sql);

if($stmt) {
    $stmt->bind_param("ssi", $title, $content, $userID);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "Erfolgreich gepostet";
        echo '<script>setTimeout(function() { window.location.href = "blog.php"; }, 2000);</script>';

    }
    else {
        echo "Posten nicht erfolgreich";
    }
    }
else{
    "Fehler bei SQL-Anweisung";
}
?>