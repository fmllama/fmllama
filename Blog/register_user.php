<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
session_start();

include_once("dbcon.php");

$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$email = $_POST["email"];

$query = "INSERT INTO users (username, password, email) VALUES (?,?,?)";
$stmt = $dbcon->prepare($query);

if($stmt) {
    $stmt->bind_param("sss", $username, $password, $email);
    $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "Benutzer erfolgreich erstellt";
            header("Location: index.php");
            exit();
        }
        else {
            echo "Erstellen der Benutzers fehlgeschlagen";
        }

    $stmt->close();
    }

else {
    echo "Fehler beim Verarbeitden der SQL-Anweisung";
}

$dbcon->close();

?>
    
</body>
</html>