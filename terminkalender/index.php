<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<h1>Termine je User</h1>
<?php

    require_once("dbcon.php");

    // $sql = "SELECT * FROM appointments INNER JOIN users ON appointments.FIDusers = users.ID
    // INNER JOIN categories ON appointments.FIDcategory = categories.ID";

    // $result = $dbcon->query($sql);

    // if($result->num_rows > 0){
    //     while ($rows = $result->fetch_assoc()){
    //         echo '<div class="' . trim($rows['colour']) . '">';
    //         echo $rows['email'] . '<br>';
    //         echo $rows['nickname'] . '<br>';
    //         echo $rows['firstname'] . '<br>';
    //         echo '<p>' . $rows['title'] . '<p>';
    //         echo '<p>' . $rows['description'] . '<p>';
    //         echo $rows['colour'];
    //         echo '</div>';
    //     }
    // }


    $sql = "SELECT * from categories";
    $catres = $dbcon->query($sql);

    if($catres->num_rows > 0){
        echo '<form action = "index.php" method = "GET">';
            echo '<select name="category" value="">';                           //value iiset $_GET[category] && GET categorie 
                echo '<option value="0">Alle</option>';
                while ($catrow = $catres->fetch_assoc()) {
                    echo '<option value="' . $catrow['id'] . '">' . $catrow['name'] . '</option>';
                    }
                    echo '</select>';
                    echo '<button type="submit">Abschicken</button>';                                       //Bei Abschicken wird es in globales GET-Array geschickt  

                    echo '</form>';
    }


    // echo '<select name="category" id="categoryDropdown">';
    // if($catres->num_rows > 0)
    //     echo '<option value="Alle">Alle</option>';
    //         while ($catrow = $catres->fetch_assoc()) {
    //             echo '<option value="' . $catrow['id'] . '">' . $catrow['name'] . '</option>';
    //             }
    //             echo '</select>';
    //             echo '<button type="submit">Abschicken</button>';        

    $sql = "SELECT * FROM users";
    $result = $dbcon->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){                           
            $email = $row['email'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $description = $row['description'];
            $id = $row['ID'];

            echo '<div class = "user_container">';
                echo '<div>' . $row['nickname'] . ' (<a href="mailto:' . $email . '">' . $email . '</a>)</div>';    
                    if($firstname || $lastname){        
                        echo '<div>';
                            if ($firstname) echo $firstname . ' ';
                            if ($lastname) echo $lastname;
                        echo '</div>';
                    }
                if($description){
                    echo '<div><i>' . $description . '</i></div>';
                }



                $sql = "SELECT * FROM appointments JOIN categories ON categories.id = appointments.FIDcategory WHERE FIDusers = $id";        //String-Variable =kann überschrieben werden
                $appointments = $dbcon->query($sql);                                                                                       //kann auch überschrieben werden, aber eher unschön

                if($appointments->num_rows > 0){
                    while ($apptrow = $appointments->fetch_assoc()){
                        $catID = $apptrow['categories.id'];
                        echo $catID;
                        if($_GET['category'] == 0 || !isset($_GET['category']) || $_GET['category'] == $apptrow['ID']){                          //GEttr auf 0 (=Alle-OPtion), Getter leer, dann alle, wenn getter gesetz, dann mit richtiger KAtegorie                                                                                      //category = name von select-option oben
                        echo '<div class="appt_container ' . trim($apptrow['colour']) . '">';
                        echo '<div class = "date"><small> von ' . $apptrow['date_from'] . ' bis ' . $apptrow['date_to'] . '</small></div>';                //date(F j,Y, g:i a', strtotime($apptrow['date_to']))
                        echo '<div><b>' . $apptrow['title'] . '</b></div>';
                        if($apptrow['location']) echo '<div><i>' . $apptrow['location'] . '</i></div>';
                        if($apptrow['description']) echo '<div><i>' . $apptrow['description'] . '</i></div>';
                    

                        echo '</div>';

                    }}
                }


            echo '</div>';
        }
    }

    $dbcon->close();

?>

<select name="dropdownName" id="dropdownId">
    <option value="option1">Alle</option>
    <option value="option2">Freizeit</option>
    <option value="option3">Arbeit</option>
    <option value="option3">Dringend</option>

</select>


</body>
</html>


<!-- Mit Dropdown filtern nach kat
wenn keine Kat vorhanden für User "Keine Freizeit-Termine"

Wenn ja mit Datum und Farbe

Filtern mit:
Arbeit
Freizeit-Termine
Dringend
Alle

Options in SELECT zwischen termine und user-->
