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

if(!isset($_SESSION['user_id'])) { ?>
    <h1>Willkommen!</h1>
    <form action="loginform.php" method="POST">
        <h3>Biite logge dich ein</h3>
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Enter username">
        <label for="email"> oder E-Mail</label>
        <input type="email" name="email" placeholder="Enter email">
        <br><br>
        <label for="password">Passwort:</label>
        <input type="password" name="password" placeholder="Enter password">
        <br><br>
        <input type="submit" value="Daten absenden">
    
    </form>

    <h4><a href="create_user.html">Noch kein User? Bitte registriere dich hier</h4></a>

    <?php } 
    else 
    echo '<h1> Willkommen, ' . $_SESSION['username']  . '!</h1> <a href="create_post.html"><h4>Möchtest du posten?<h4></a> 
    <a href="blog.php"><h4>Oder lieber zum Blog?<h4></a>'; ?>

</body>
</html>