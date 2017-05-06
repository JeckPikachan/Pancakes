<?php
session_start();
$_SESSION["pancakeId"] = intval($_GET["pancakeId"]);
$id = $_SESSION["pancakeId"];

$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
$mysqli->query("SET NAMES 'utf8'"); 

$price = $mysqli->query("SELECT `price` FROM `pancakes` WHERE `id` = ".$id);
$row = $price->fetch_assoc();
$_SESSION["pancakePrice"] = $row["price"];

$_SESSION["totalPrice"] = $_SESSION["pancakePrice"] + $_SESSION["fillingsPrice"] + $_SESSION["envelopePrice"];

$arr = array('price' => $row["price"], 'id' => $id, 'total' => $_SESSION["totalPrice"]);
$mysqli->close();
echo json_encode($arr);
