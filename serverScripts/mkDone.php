<?php
	$id = $_GET["id"];
	
	$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
	$mysqli->query("SET NAMES 'utf8'"); 
	
	$mysqli->query("UPDATE `orders` SET `done` = 1 WHERE `id` = $id");
	
	$mysqli->close();
	
	echo $id;