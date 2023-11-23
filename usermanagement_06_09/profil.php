<?php include_once('header.php'); ?> 

<main>

    <h1>Profil bearbeiten</h1>

    <?php 
        require_once('database/database_con.php');

        $select="SELECT * FROM books WHERE username='".$_SESSION['username']."'";
        $result = $dbcon->query($select);

        if($result->num_rows > 0) {
            echo '<div id="book-table">';
                while($row = $result->fetch_object()){
                    echo '<div class="book-row">';
                        echo '<div>'.$row->title.'</div>';
                        echo '<div>'.$row->description.'</div>';
                        echo '<div><form action="bookborrowed.php" method="POST">';
                            echo '<input type="hidden" name="isbn" value="'.$row->isbn.'">';
                            echo '<button type="submit">Buch zurückgeben</button>';
                        echo '</form></div>';
                    echo '</div>';
                }
            echo '</div>';
        }else {
            echo '<h3>Du hast dir kein Buch ausgeliehen</h3>';
        }


    ?>


</main>


<?php include_once('footer.php'); ?> 