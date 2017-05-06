<?php

session_start();

$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
$mysqli->query("SET NAMES 'utf8'"); 

$pancakeId = $_SESSION["pancakeId"];
$set = $mysqli->query("SELECT `name` FROM `pancakes` WHERE `id` = ".$pancakeId);
$row = $set->fetch_assoc();
$pancakeName = $row["name"];

$fillings = "";
foreach ($_SESSION["fillingsChosen"] as $id => $isChosen) {
	if ($isChosen) {
		$set = $mysqli->query("SELECT `name` FROM `fillings` WHERE `id` = ".$id);
		$row = $set->fetch_assoc();
		if ($fillings == "" ) $fillings .= $row["name"];
		else $fillings .= "+".$row["name"];
	}
}

$code = md5($_SESSION["code"]);

$isDone = 0;

$show = 1;

$totalPrice = $_SESSION["totalPrice"];

$addQuery = "INSERT INTO `orders` (`pancakeName`, `fillings`, `code`, `done`, `show`, `totalPrice`) VALUES ('$pancakeName', '$fillings', '$code', $isDone, $show, $totalPrice)";


if ($mysqli->query($addQuery) === TRUE) {
	$_SESSION["orderId"] = $mysqli->insert_id;
} else {
    echo "Error: " . $addQuery . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

