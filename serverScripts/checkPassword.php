<?php

	$id = $_GET["id"];
	$pass = $_GET["pass"];
	
	$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
	$mysqli->query("SET NAMES 'utf8'");
	
	$set = $mysqli->query("SELECT `code` FROM `orders` WHERE `id` = $id");
	
	$response = false;
	
	$row = $set->fetch_assoc();
	
	if($row["code"] == md5($pass)) {
		$mysqli->query("UPDATE `orders` SET `show` = 0, `done` = 1 WHERE `id` = $id");
		$response = true;
	}
	
	echo $response;