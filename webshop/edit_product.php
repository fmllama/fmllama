<?php
$pageTitle = "Bearbeiten für Admin";
require_once('header.php');
require_once("dbcon.php");

if(isset($_GET['edit_id'])) {
    $product_id = $_GET['edit_id'];
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $dbcon->prepare($query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $price = $row['price'];
        $desc = $row['description'];
        $pic = $row['picture'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hier die POST-Daten abrufen und das Produkt aktualisieren
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $pic = $_POST['pic'];

    $sql = "UPDATE products SET name = ?, price = ?, description = ?, picture = ? WHERE id = ?";
    $update_stmt = $dbcon->prepare($sql);
    $update_stmt->bind_param('sdssi', $name, $price, $desc, $pic, $product_id);
    $update_stmt->execute();

    if($update_stmt->affected_rows > 0){
        echo "Produkt erfolgreich aktualisiert.";
    } else {
        echo "Fehler beim Aktualisieren des Produkts.";
    }
}
?>

<h3>Produkt bearbeiten</h3>

<form method="POST">
    Name des neuen Produkts: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>
    Preis des neuen Produkts: <input type="text" name="price" value="<?php echo $price; ?>"><br>
    Beschreibung des Produkts: <textarea name="desc" cols="30" rows="10"><?php echo htmlspecialchars($desc); ?></textarea><br>
    Bildpfad des Produkts: <input type="text" name="pic" value="<?php echo htmlspecialchars($pic); ?>"><br>
    <button type="submit">Produkt bearbeiten</button>
</form>



