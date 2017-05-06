<?php
session_start();

$_SESSION["pancakeId"] = 0;
$_SESSION["pancakePrice"] = 0;
$_SESSION["fillingId"] = 0;
$_SESSION["fillingsPrice"] = 0;
$_SESSION["totalPrice"] = 0;
$_SESSION["envelopePrice"] = 0.08;
$_SESSION["code"] = "";
$_SESSION["orderId"] = 0;

$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
$mysqli->query("SET NAMES 'utf8'"); 

$maxId = $mysqli->query("SELECT MAX(`id`) FROM `fillings`")->fetch_assoc();
$minId = $mysqli->query("SELECT MIN(`id`) FROM `fillings`")->fetch_assoc();
$minId = $minId["MIN(`id`)"];
$maxId = $maxId["MAX(`id`)"];
$isFillingChosen = array_fill($minId, $maxId - $minId + 1, false);
$_SESSION['fillingsChosen'] = $isFillingChosen;

function showPancakesTable() {
	$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
	$mysqli->query("SET NAMES 'utf8'"); 
	$set = $mysqli->query("SELECT `id`, `name`, `price` FROM `pancakes`");
	
	echo '<table id="pancakeTable" class="table table-hover">
		  <thead><tr><th>Название</th><th>Цена</th></tr></thead>
		  <tbody>';
	
	while ($row = $set->fetch_assoc()) {
		echo "<tr id=".$row["id"]." class=\"pancake\"><td>".$row["name"]."</td><td>".$row["price"]." BYN</td></tr>";
	}
	
	echo '</tbody>
		  </table>';
		  
	$mysqli->close();
}

function showFillingsTable() {
	$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
	$mysqli->query("SET NAMES 'utf8'"); 
	$fillings = $mysqli->query("SELECT `id`, `name`, `price` FROM `fillings`");
	
	echo '<table id="fillingTable" class="table table-hover">
		  <thead><tr><th>Название</th><th>Цена</th></tr></thead>
		  <tbody>';
		
	while ($row = $fillings->fetch_assoc()) {
		echo "<tr id='f".$row["id"]."' class=\"filling\"><td>".$row["name"]."</td><td>".$row["price"]." BYN</td></tr>";
	}
	
	echo '</tbody>
		  </table>';
		  
	$mysqli->close();
}

?>