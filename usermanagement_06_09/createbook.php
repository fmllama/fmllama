<?php include_once('header.php'); ?> 

<main>

    <h1>Buch hinzufügen</h1>
    <!--
        block (h1-6, div, nav, ul, ol, li, br, form)
        inline (img, span, strong, b, i, label)
        inline-block (rein in css um höhen / padding zu vergeben)
     -->
    <?php if(!isset($_POST['isbn'])) : ?>
        <form class="bookforms" action="createbook.php" method="POST" 
                enctype="multipart/form-data">
            <label>
                ISBN <input type="number" name="isbn" max='999999999' maxlength='9' required />
            </label>
            <label>
                Titel <input type="text" name="title" required />
            </label>
            <label>
                Genre <input type="text" name="genre"  />
            </label>
            <label>
                Autor <input type="text" name="author"  />
            </label>
            <textarea name="description" >Beschreibung</textarea>
            <input type="file" name="bookcover" /> <!-- $_FILES -->
            <button type="submit">Buch hinzufügen</button>
        </form>
    <?php else : 
        //Datenbankverbindung
        //select Statement
        //wenn isbn in der Datenbank vorhanden ---> FEHLERMELDUNG
        //wenn nicht vorhanden, weiter zum INSERT Statement
        require_once('database/database_con.php');
        $select='SELECT isbn from books WHERE isbn='.$_POST['isbn'];
        $result = $dbcon->query($select);

        //var_dump($_POST);
        

        
        if($result->num_rows > 0) {
            echo '<h3>ISBN schon vorhanden</h3>';
        }else {
            //var_dump($_POST);
            var_dump($_FILES);

            $image = '';

            if(is_uploaded_file($_FILES['bookcover']['tmp_name'])) {
                move_uploaded_file($_FILES['bookcover']['tmp_name'], 'images/' . $_FILES['bookcover']['name'] );
                $image = $_FILES['bookcover']['name'];
            }


            $insert = $dbcon->prepare("INSERT INTO books 
                        (isbn, title, author, genre, description, images, in_stock)
                        VALUES(?,?,?,?,?,?, 1)");
            $insert->bind_param("isssss", $_POST['isbn'], $_POST['title'], $_POST['author'], 
                            $_POST['genre'], $_POST['description'], $image);
            
            if($insert->execute()){
                echo '<h3>Das Buch wurde erfolgreich hinzugefügt</h3>';
            }
            else {
                echo '<h3>Das Buch konnte nicht hinzugefügt werden</h3>';
            }

            $insert->close();
        }

        $dbcon->close();

        endif; ?>

</main>

<?php include_once('footer.php'); ?> 