<?php 
    $dbcon = new mysqli('localhost', 'root', '', 'usermanagement_23'); 

    if($dbcon->connect_errno)
        exit();

?>