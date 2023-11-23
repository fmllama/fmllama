<?php

require_once('header.php');
require_once("dbcon.php");

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];


    //PPER

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $dbcon->prepare($sql);

    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if (password_verify($password, $row['password'])) {
                $_SESSION["role"] = $row['role_id'];
                $_SESSION["user_id"] = $row['id'];
                
                if($_SESSION["role"] == 1){
                    echo '<a href="admin_products.php">Zur Produkt-Bearbeitung für den Admin</a>';
                    } else echo "Login erfolgreich!";
            } else {
                echo "Email oder Benutzername falsch";
            }
        }
    } else {
        "Email oder Benutzername falsch";
    }
} else {
    "Bitte gib deine Daten ein";
}
