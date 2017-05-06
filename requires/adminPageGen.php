<?php

function showOrdersTable() {
	$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
	$mysqli->query("SET NAMES 'utf8'"); 
	$orders = $mysqli->query("SELECT `id`, `pancakeName`, `fillings`, `done`, `totalPrice` FROM `orders` WHERE `show` = 1");

	echo '<table class="table table-hover">
		  <thead><tr><th>№</th><th>Блин</th><th>Начинки</th><th>Цена</th><th>Готово</th><th>Забрать</th></tr></thead>
		  <tbody>';
	
	while ($row = $orders->fetch_assoc()) {
		$done = "";
		if ($row["done"] == 1) $done = "success";
		echo "<tr id='".$row["id"]."' class='pancake $done'><td>".$row["id"]."</td><td>".$row["pancakeName"]."</td><td>".$row["fillings"]."</td><td>".$row["totalPrice"]."</td><td><button class='readyBtn'>Готово</button></td><td><button class='getBtn'>Забрать</button></td></tr>";
	}
	
	echo '</tbody>
		  </table>';

	$mysqli->close();
}
?>