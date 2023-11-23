<?php
session_start();
include_once('dbcon.php');
include_once('header.php');
echo '<h1>Posts</h1>';

$select = 'SELECT posts.ID, title, content, timestamp, username FROM posts INNER JOIN users ON posts.user_id = users.ID';
$result = $dbcon->query($select);

if ($result->num_rows >0){

    while($row = $result->fetch_assoc()){                                                           //$row kann heißen wie man will
        echo '<h3>' . $row['title'] . '</h3>';
        echo $row['content'] . '<br><br>';
        echo '<small>Gepostet am ' . $row['timestamp'] . '</small><br>';
        echo '<small>Gepostet von ' . $row['username'] . '</small><br>';
        
        echo '<a href = "delete_post.php?delete_id=' . $row['ID'] . '">Post löschen</a><br>';
        echo '<a href = "update.php?update_id=' . $row['ID'] . '">Post bearbeiten</a><br><br>';
        

        }
}

echo '<br><br><a href = create_post.html>Zurück zum Posten</a>';
echo '<br><br><a href = index.php>Zurück zur Startseite</a>';


?>