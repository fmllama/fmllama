<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

$msg = "";

if(count($_POST)>0) {
    $sql = "
        SELECT COUNT(*) AS cnt FROM tbl_user
        WHERE(
            Emailadresse='" . $conn->real_escape_string($_POST["E"]) . "'
        )
    ";
    $query = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
    $data = $query->fetch_object();
    if($data->cnt==0) {
        $sql = "
            INSERT INTO tbl_user
                (Emailadresse,Passwort,Nachname,FIDGeschlecht,GebDatum)
            VALUES (
                '" . $conn->real_escape_string($_POST["E"]) . "',
                '" . password_hash($_POST["P0"],PASSWORD_DEFAULT) . "',
                '" . $conn->real_escape_string($_POST["VN"]) . "',
                '" . $conn->real_escape_string($_POST["geschlecht"]) . "',
                '" . $conn->real_escape_string($_POST["GD"]) . "'
            )
        ";
        $ok = $conn->query($sql) or die("Fehler in der Query: ".$conn->error."<br>".$sql);
        if($ok) {
            $mgs = '<p class="success">Vielen Dank für die Registrierung.</p>';
        }
        else {
            $mgs = '<p class="error">Leider war die Registrierung nicht ok.</p>';
        }
    }
    else {
        $mgs = '<p class="error">Dieser User existiert in unserem System bereits.</p>';
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Testen</title>
<link rel="stylesheet" href="css/common.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <h1>Testen (Registrierung)</h1>
    <?php echo($msg); ?>
    <form method="post">
        <fieldset>
            <legend>Zugangsdaten</legend>
            <label data-required>
                Emailadresse:
                <input type="text" name="E">
            </label>
            <label data-required>
                Passwort:
                <input type="password" name="P0" required>
                <input type="password" name="P1" required placeholder="Passwort wiederholen">
            </label>
        </fieldset>
        <fieldset>
            <legend>freiwillige Angaben</legend>
            <label>
                Vorname:
                <input type="text" name="VN">
            </label>
            <label>
                Nachname:
                <input type="text" name="NN">
            </label>
            Geschlecht:
            <label>
                <input type="radio" name="geschlecht" value="m">
                weiblich
            </label>
            <label>
                <input type="radio" name="geschlecht" value="w">
                männlich
            </label>
            <label>
                <input type="radio" name="divers" value="d">
                divers
            </label>
            <label>
                Geburtsdatum:
                <input type="date" name="GD" required>
            </label>
        </fieldset>
        <input type="submit" value="registrieren">
    </form>
</body>
</html>