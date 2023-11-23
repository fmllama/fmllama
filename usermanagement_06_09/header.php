<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usermanagement</title>
    <!-- SERVER! Daten -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/usermanagement/css/style.css" />
    <?php session_start(); ?> 
</head>
<body>
    <?php
    //var_dump($_GET);
    if(isset($_GET['logout']) && $_GET['logout'] == 'true')
        session_unset(); //session_destroy();

    //echo $_SESSION['userrights'];
    
    if(isset($_SESSION['username'])) : ?>
        <header>
            <a class="startpage" href="index.php">Usermanagement</a>
            <nav>
                <ul class="menu">
                    <li><?php echo $_SESSION['fullname'] ?></li>
                    <?php if(trim($_SESSION['userrights']) == 'admin') : ?>
                        <li><a href="createbook.php">Buch hinzufügen</a></li>
                    <?php endif; ?>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="index.php?logout=true">Logout</a></li>
                </ul>
            </nav>
        </header>

    <?php endif; ?> 

    <?php /*
        echo '<pre>';
        print_r($_SERVER);
        echo '</pre>';*/
    ?>