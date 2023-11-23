<!-- mit Header HTML evtl. nicht notwendig-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Reisetagebuch</h1>

    <!-- <form action="" method = "POST"> 
    <?php
        require_once('dbcon.php');

    $select = 'SELECT title FROM journey';
    $res = $dbcon->query($select);
    
    if($res->num_rows > 0){
        while ($rows = $res->fetch_assoc()){
            echo '<input type="checkbox">' . $rows['title'];
        }
    }

    ?>
    </form> -->
    <?php

    $sql = "SELECT * FROM journey";
    $result = $dbcon->query($sql);



    if($result->num_rows > 0){

        echo '<form action = "index.php" method = "GET">';

            while($row = $result->fetch_assoc()){
                $checked = 
                $journeyID = $row['ID'];
                $title = $row['title'];

                echo '<label><input type = "checkbox" name = "journey' . $journeyID .'" value = "' . $journeyID .'">' . $title . '</label>';
            }
        

            echo '<p><button type="submit">Filtern</button></p>';            

        echo '</form>';

        $result = $dbcon->query($sql);

        
        while ($row = $result->fetch_assoc()){                                           //$row kann heißen wie man will
            if(isset($_GET["journey" . $row['ID']])){
            echo '<div>';
            echo '<h3>' . $row['title'] . '</h3>';
            echo '<p>' . $row['description'] . '</p>';
            echo '<div>';
            echo '<a href = "sections.php?id=' . $row['ID'] . '">Mehr lesen</a><br>';    //? ist für GET
        
        }
    }
}

    ?>



</body>
</html>