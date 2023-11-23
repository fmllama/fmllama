<?php  include_once('header.php'); ?>

<main>
    <?php 
        if(!isset($_SESSION['username'])) :
    ?>
        <!-- wenn ich nicht angemeldet bin: login-formular -->

        <form class="loginform" action="database/senduserform.php" method="POST"> <!-- GET / POST -->
            <h1>Login</h1>
            <label>Username</label>
            <input type="text" name="username" required/>
            <label>Password</label>
            <input type="password" name="password" required />
            <button type="submit">Einloggen</button>
        </form>
    <?php else : ?> 
        <!-- wenn eingeloggt - user mit usernamen begrüßen --> 

        <h3>Willkommen <?php echo $_SESSION['username'] ?>, schön, dass du da bist!</h3>
        <h2>Bücherverleih</h2>
        <?php 
            require_once('database/database_con.php');
            $select = "SELECT isbn, title, description, in_stock FROM books";
            $result = $dbcon->query($select);

            if($result->num_rows > 0) {
                echo '<div id="book-table">';
                while($row = $result->fetch_assoc()) {
                    echo '<div class="book-row">';
                        echo '<div><a href="bookdetail.php?isbn='.$row['isbn'].'">'. $row['title'] . '</a></div>';
                        echo '<div>'. $row['description'] . '</div>';
                        echo '<div>';
                            echo '<form action="bookborrowed.php" method="POST" >';
                                echo '<input type="hidden" name="isbn" value="'.$row['isbn'].'" />'; //$_POST['isbn']
                                echo '<input type="hidden" name="username" value="'.$_SESSION['username'].'"/>';
                                echo '<button type="submit" ';
                                    if($row['in_stock'] == 0) echo 'disabled';
                                echo '>Buch ausleihen</button>'; 
                            echo '</form>';
                        echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            } 

            $dbcon->close();

        ?>


    <?php endif; ?> 
</main>

<?php include_once('footer.php'); ?>