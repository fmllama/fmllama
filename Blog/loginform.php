<?php
session_start();

include_once('dbcon.php');

$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];

$sql = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $dbcon->prepare($sql);

if($stmt){
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_id'] = $row['ID'];
            echo 'Erfolgreich eingeloggt!';
            echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 2000);</script>';
            exit();

        } else {
            echo 'Falsches Passwort!';
        }

    } else {
        echo 'Benutzername oder E-Mail existiert nicht!';
    }

    $stmt->close();
}
else {
    echo 'SQL-Fehler';
}

$dbcon->close();



?>