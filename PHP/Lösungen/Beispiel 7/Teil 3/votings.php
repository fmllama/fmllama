<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

function marken_show():string {
	global $conn;
	
	$r = '<select name="IDMarke" required>';
	
	$sql = "
		SELECT
			*
		FROM tbl_marken
		ORDER BY Marke ASC
	";
	$marken = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($marke = $marken->fetch_object()) {
		$r.= '<option value="' . $marke->IDMarke . '">' . $marke->Marke . '</option>';
	}
	
	$r.= '</select>';
	return $r;
}

function skala_show():string {
	global $conn;
	
	$r = '<select name="IDSkala" required>';
	
	$sql = "
		SELECT
			*
		FROM tbl_skala
		ORDER BY Wert DESC
	";
	$werte = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($wert = $werte->fetch_object()) {
		$r.= '<option value="' . $wert->IDSkala . '">' . $wert->Skala . '</option>';
	}
	
	$r.= '</select>';
	return $r;
}

function bewertungen_show():string {
	global $conn;
	
	$r = '<ul class="bewertungen">';
	
	$sql = "
		SELECT
			tbl_marken.IDMarke,
			tbl_marken.Marke,
			(
				SELECT AVG(tbl_skala.Wert) AS avg
				FROM tbl_votings
				INNER JOIN tbl_skala ON tbl_skala.IDSkala=tbl_votings.FIDBewertung
				WHERE(
					tbl_votings.FIDMarke=IDMarke
				)
			) AS avg,
			(
				SELECT MAX(Wert) AS max
				FROM tbl_skala
			) AS max
		FROM tbl_marken
		ORDER BY Marke ASC
	";
	
	$votings = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($voting = $votings->fetch_object()) {
		$r.= '
			<li><span class="voting">' . round($voting->avg,1) . '/' . $voting->max . ' Sterne</span> <span class="marke">' . $voting->Marke . '</span>:
				<ul>
		';
		
		// ---- textuelle Bewertungen je Marke: ----
		$sql = "
			SELECT
				Bewertungstext,
				User
			FROM tbl_votings
			WHERE(
				FIDMarke=" . $voting->IDMarke . " AND
				LENGTH(Bewertungstext)>0
			)
		";
		$texte = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
		while($text = $texte->fetch_object()) {
			$r.= '
				<li>
					<span class="user">' . $text->User . ':</span>
					<div class="text">' . $text->Bewertungstext . '</div>
				</li>
			';
		}
		// -----------------------------------------
		
		$r.= '
				</ul>
			</li>
		';
	}

	
	$r.= '</ul>';
	return $r;
}

function res(string $in):string {
	global $conn;
	return $conn->real_escape_string($in);
}

function integer_check(string|int $in):int|string {
	$r = intval($in)>0 ? intval($in) : "NULL";
	return $r;
}
function string_check(mixed $in):string {
	$r = strlen(strval($in))>0 ? "'" . strval($in) . "'" : "NULL";
	return $r;
}

$msg = "";
if(count($_POST)>0) {
	$sql = "
		SELECT COUNT(*) AS cnt
		FROM tbl_votings
		WHERE(
			User='" . res($_POST["N"]) . "' AND
			FIDMarke=" . res($_POST["IDMarke"]) . "
		)
	";
	$votings = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	$voting = $votings->fetch_object();
	if($voting->cnt==0) {
		//DIESER User hat DIESE Marke noch nicht bewertet --> eintragen
		$sql = "
			INSERT INTO tbl_votings
				(FIDMarke, User, FIDBewertung, Bewertungstext)
			VALUES (
				" . integer_check($_POST["IDMarke"]) . ",
				" . string_check($_POST["N"]) . ",
				" . integer_check($_POST["IDSkala"]) . ",
				" . string_check($_POST["BT"]) . "
			)
		";
		ta($sql);
		$ok = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
		if($ok) {
			$msg = '<p class="success">Vielen Dank für Ihre Bewertung.</p>';
		}
	}
	else {
		$msg = '<p class="error">Sie können diese Marke nur einmal bewerten.</p>';
	}
}
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Poolroboter</title>
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/poolroboter.css">
</head>

<body>
	<nav>
		<ul>
			<li><a href="index.html">Startseite</a></li>
			<li><a href="poolroboter.php">Poolroboter</a></li>
		</ul>
	</nav>
	<h1>Votings</h1>
	<?php echo($msg); ?>
	<form method="post">
		<label>
			Welche Marke möchten Sie bewerten:
			<?php echo(marken_show()); ?>
		</label>
		<label>
			Ihr Name:
			<input type="text" name="N" required>
		</label>
		<label>
			Ihre Bewertung:
			<?php echo(skala_show()); ?>
			<textarea name="BT" placeholder="optionale textuelle Bewertung"></textarea>
		</label>
		<input type="submit" value="bewerten">
	</form>
	<h2>Bewertungen</h2>
	<?php echo(bewertungen_show()); ?>
</body>
</html>