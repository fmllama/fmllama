<?php

$dbcon = new mysqli("localhost", "root", "", "webshop");

if($dbcon->connect_errno){
    die("Verbindung fehlgeschlagen: " . $dbcon->connect_error);
}


?>