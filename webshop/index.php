
<?php
$pageTitle = "Startseite";
require_once('header.php');

?>

<form action="login.php" method="POST">
    
Email: <input type="email" name="email" id="email" required><br>
Passwort: <input type="password" name="password" id="password" required><br>
<button type="submit" value="login">Login</button>

</form>


<a href="products.php">Produkte</a>

</body>
</html>