<?php

    $dbcon = new mysqli('localhost', 'root','', 'reisetagebuch');

    if($dbcon->connect_error){
        die('Verbindung fehlgeschlagen');
    }

?>