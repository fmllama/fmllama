<?php include_once('header.php'); ?> 

<main>

    <?php //var_dump($_GET); ?>
    <h1>Buchdetail</h1>

    <?php
        require_once('database/database_con.php');

        $select = "SELECT * from books where isbn=".$_GET['isbn'];
        $result = $dbcon->query($select);

        if($result->num_rows) {
            echo '<div id="book-detail">';
                while($row = $result->fetch_assoc()) {
                    echo '<div class="row">';
                        echo '<div class="col-6"><img src="images/'.$row['images'].'" /> </div>';
                        echo '<div class="col-6"><h2>'. $row['title'] . '</h2>';
                        if($row['author']) echo '<b>'. $row['author'] . '</b>';
                        if($row['genre']) echo ' <i>'. $row['genre'] . '</i>';
                        echo '<div>'. $row['description'] . '</div>';
                        //DELETE BUTTON HERE
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
        }


    ?>



</main>


<?php include_once('footer.php'); ?> 