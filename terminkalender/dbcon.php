<?php

    $dbcon = new mysqli("localhost", "root","","appointment_book");

    if($dbcon->connect_errno){
        die("Verbindung fehlgeschlagen");
    }

?>