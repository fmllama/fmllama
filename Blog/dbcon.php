<?php

    $dbcon = new mysqli('localhost', 'root', '', 'blog');

    if ($dbcon->connect_error){
        die('Verbindung fehlgeschlagen');
}
?>