<?php
session_start();
$_SESSION["fillingId"] = intval($_GET["fillingId"]);

$id = $_SESSION["fillingId"];

$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
$mysqli->query("SET NAMES 'utf8'"); 

$set = $mysqli->query("SELECT `price` FROM `fillings` WHERE `id` = ".$id);
$row = $set->fetch_assoc();
$price = $row["price"];

if ($_SESSION["fillingsChosen"][$id]) {
	$_SESSION["fillingsChosen"][$id] = false;
	$_SESSION["fillingsPrice"] -= $price;
	if($_SESSION["fillingsPrice"] < 0) $_SESSION["fillingsPrice"] = 0;
} else {
	$_SESSION["fillingsChosen"][$id] = true;
	$_SESSION["fillingsPrice"] += $price;
}

$_SESSION["totalPrice"] = $_SESSION["pancakePrice"] + $_SESSION["fillingsPrice"] + $_SESSION["envelopePrice"];

$arr = array('price' => $_SESSION["fillingsPrice"], 'id' => $id, 'total' => $_SESSION["totalPrice"]);
$mysqli->close();
echo json_encode($arr);