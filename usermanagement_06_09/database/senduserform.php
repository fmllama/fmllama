<?php include_once('../header.php'); ?> 

<main>
    <?php

        //$_GET $_POST

        //var_dump($_POST);
        //echo '<h2>' . $_POST['username'] . '</h2>';

        $dbcon = new mysqli('localhost', 'root', '', 'usermanagement_23');

        if($dbcon->connect_errno) {
            echo 'Datenbankverbindung fehlgeschlagen: ' . $dbcon->connect_error;
        }else {
            echo 'Datenbankverbindung hat funktioniert';

            $username=$_POST['username'];
            $password= md5($_POST['password']);

            $select = "SELECT * from user WHERE user_name='".$_POST['username']."' 
                        AND user_password='$password'";
            //echo $select;
            //select * from user where user_name="lisa"

            $result = $dbcon->query($select);

            if($result->num_rows > 0) {
                //hier einloggen
                //$_SESSION
                while($row = $result->fetch_assoc()) {
                    //$row['user_name']
                    $_SESSION['username'] = $row['user_name'];
                    $_SESSION['userrights'] = $row['user_rights'];
                    $_SESSION['fullname'] = $row['user_fullname'];
                }
                echo '<h2>Du wurdest erfolgreich eingeloggt</h2>';
                echo '<a href="../index.php">Zurück zur Startseite</a>';
            }else {
                echo '<h2>Passwort und Username stimmen nicht überein</h2>';
                echo '<a href="../index.php">Zurück zum Login</a>';
            }
        }

        $dbcon->close();

    ?>



</main>

<?php include_once('../footer.php'); ?> 