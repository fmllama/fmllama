<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

function marken_show(int $idMarke=0):string {
	global $conn;
	
	$r = '
		<select name="IDMarke" required>
			<option value="0">Bitte wählen:</option>
	';
	
	$sql = "
		SELECT
			*
		FROM tbl_marken
		ORDER BY Marke ASC
	";
	$marken = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($marke = $marken->fetch_object()) {
		$sel = $marke->IDMarke==$idMarke ? "selected" : "";
		$r.= '<option value="' . $marke->IDMarke . '" ' . $sel . '>' . $marke->Marke . '</option>';
	}
	
	$r.= '</select>';
	return $r;
}

function nutzungsarten_show(int $idNutzungsart=0):string {
	global $conn;
	
	$r = '
		<select name="IDNutzungsart" required>
			<option value="0">Bitte wählen:</option>
	';
	
	$sql = "
		SELECT
			*
		FROM tbl_nutzungsarten
		ORDER BY Nutzungsart ASC
	";
	$arten = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($art = $arten->fetch_object()) {
		$sel = $art->IDNutzungsart==$idNutzungsart ? "selected" : "";
		$r.= '<option value="' . $art->IDNutzungsart . '" ' . $sel . '>' . $art->Nutzungsart . '</option>';
	}
	
	$r.= '</select>';
	return $r;
}
function poolarten_show(int $idPoolart=0):string {
	global $conn;
	
	$r = '
		<select name="IDPoolart" required>
			<option value="0">Bitte wählen:</option>
	';
	
	$sql = "
		SELECT
			*
		FROM tbl_poolarten
		ORDER BY Poolart ASC
	";
	$arten = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($art = $arten->fetch_object()) {
		$sel = $art->IDPoolart==$idPoolart ? "selected" : "";
		$r.= '<option value="' . $art->IDPoolart . '" ' . $sel . '>' . $art->Poolart . '</option>';
	}
	
	$r.= '</select>';
	return $r;
}

function res(string $in):string {
	global $conn;
	return $conn->real_escape_string($in);
}

if(count($_POST)>0) {
	$_POST["IDMarke"] = strlen($_POST["IDMarke"])>0 ? intval($_POST["IDMarke"]) : 0;
	$_POST["IDPoolart"] = strlen($_POST["IDPoolart"])>0 ? intval($_POST["IDPoolart"]) : 0;
	$_POST["IDNutzungsart"] = strlen($_POST["IDNutzungsart"])>0 ? intval($_POST["IDNutzungsart"]) : 0;
}
else {
	$_POST["IDMarke"] = 0;
	$_POST["IDPoolart"] = 0;
	$_POST["IDNutzungsart"] = 0;
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
			<li><a href="votings.php">Votings</a></li>
		</ul>
	</nav>
	<h1>Poolroboter</h1>
	<form method="post">
		<label>
			Marke:
			<?php echo(marken_show($_POST["IDMarke"])); ?>
		</label>
		<label>
			Nutzungsart:
			<?php echo(nutzungsarten_show($_POST["IDNutzungsart"])); ?>
		</label>
		<label>
			Poolart:
			<?php echo(poolarten_show($_POST["IDPoolart"])); ?>
		</label>
		<input type="submit" value="filtern">
	</form>
	<?php
	$w = "";
	if(count($_POST)>0) {
		$arr = [];
		if(intval($_POST["IDMarke"])>0) {
			$arr[] = "tbl_poolroboter.FIDMarke=" . intval($_POST["IDMarke"]);
		}
		if(intval($_POST["IDPoolart"])>0) {
			$arr[] = "tbl_poolroboter.FIDPoolart=" . intval($_POST["IDPoolart"]);
		}
		if(intval($_POST["IDNutzungsart"])>0) {
			$arr[] = "tbl_poolroboter.FIDNutzungsart=" . intval($_POST["IDNutzungsart"]);
		}
		
		if(count($arr)>0) {
			$w = "
				WHERE(
					" . implode(" AND ",$arr) . "
				)
			";
		}
	}
	
	$sql = "
		SELECT
			tbl_poolroboter.Poolroboter,
			tbl_poolroboter.Beschreibung,
			tbl_poolroboter.Artikelnummer,
			tbl_marken.Marke,
			tbl_poolarten.Poolart,
			tbl_nutzungsarten.Nutzungsart
		FROM tbl_poolroboter
		INNER JOIN tbl_marken ON tbl_marken.IDMarke=tbl_poolroboter.FIDMarke
		INNER JOIN tbl_poolarten ON tbl_poolarten.IDPoolart=tbl_poolroboter.FIDPoolart
		LEFT JOIN tbl_nutzungsarten ON tbl_nutzungsarten.IDNutzungsart=tbl_poolroboter.FIDNutzungsart
		" . $w . "
		ORDER BY tbl_marken.Marke ASC, tbl_poolroboter.Poolroboter ASC
	";
	$robs = $conn->query($sql) or die("Fehler in der Query: " . $conn->error . "<br>" . $sql);
	while($roboter = $robs->fetch_object()) {
		echo('
			<article>
				<div>
					<span class="marke">' . $roboter->Marke . '</span>
					<div class="roboter">
						<span class="modell">' . $roboter->Poolroboter . '</span>
						<span class="artno">' . $roboter->Artikelnummer . '</span>
					</div>
				</div>
				<div class="beschreibung">' . $roboter->Beschreibung . '</div>
				<ul>
					<li>Poolart: ' . $roboter->Poolart . '</li>
					<li>Nutzungsart: ' . $roboter->Nutzungsart . '</li>
				</ul>
			</article>
		');
	}
	?>
</body>
</html>