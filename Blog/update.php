<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
require_once('dbcon.php');
include_once('header.php');

if(isset($_GET['update_id'])) {
    $post_id = $_GET['update_id'];

}
$query = "SELECT title, content FROM posts WHERE ID = $post_id";
$stmt = $dbcon->query($query);

if($stmt-> num_rows > 0){

    while($row = $stmt->fetch_assoc()){
        $title = $row['title'];
        $content = $row['content'];
    }
}

?>

<form action="update_post.php" method="POST">
<input type="hidden" name="ID" value="<?php echo $post_id ?>">
<label for="title">Titel</label>
<input type="text" name="title" value = "<?php echo $title ?> ">
<br><br>
<label for="content">Post</label>
<textarea name="content" cols="60" rows="10"><?php echo $content ?></textarea>
<br><br>
<button type="submit">Speichern</button>
</form>

<br><br>
<a href="blog.php">Zurück zum Blog ohne Bearbeiten</a>





</body>
</html>