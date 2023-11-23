<?php include_once('header.php'); ?>

<main>
    <?php 
        //var_dump($_POST);
        require_once('database/database_con.php');

        //$update= "UPDATE books SET in_stock=0, username='".$_POST['username']."' WHERE isbn=".$_POST['isbn'];
        //$dbcon->query($update);
        if(isset($_POST['username'])) {
            $update= $dbcon->prepare("UPDATE books SET in_stock=0, username=? WHERE isbn=?");
            $update->bind_param("si", $username, $isbn);

            $username = $_POST['username'];
            $isbn = $_POST['isbn'];

            if($update->execute())
                echo '<h3>Buch wurde erfolgreich ausgeliehen</h3>';
            else
                echo '<h3>Buch konnte nicht ausgeliehen werden</h3>';
        }else {
            $update= $dbcon->prepare("UPDATE books SET in_stock=1, username='' WHERE isbn=?");
            $update->bind_param("i", $isbn);

            $isbn = $_POST['isbn'];

            if($update->execute())
                echo '<h3>Buch wurde erfolgreich zurückgegeben</h3>';
            else
                echo '<h3>Buch konnte nicht zurückgegeben werden</h3>';
        }

        $update->close();
        $dbcon->close();

    ?>


</main>


<?php include_once('footer.php'); ?>