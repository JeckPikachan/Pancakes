<?php
session_start();

$_SESSION["pancakeId"] = 0;
$_SESSION["pancakePrice"] = 0;
$_SESSION["fillingId"] = 0;
$_SESSION["fillingsPrice"] = 0;
$_SESSION["totalPrice"] = 0;

$mysqli = new mysqli("localhost", "root", "", "pancakesdb");
$mysqli->query("SET NAMES 'utf8'"); 
$set = $mysqli->query("SELECT `id`, `name`, `price` FROM `pancakes`");
$fillings = $mysqli->query("SELECT `id`, `name`, `price` FROM `fillings`");

$maxId = $mysqli->query("SELECT MAX(`id`) FROM `fillings`")->fetch_assoc();
$minId = $mysqli->query("SELECT MIN(`id`) FROM `fillings`")->fetch_assoc();
$minId = $minId["MIN(`id`)"];
$maxId = $maxId["MAX(`id`)"];
$isFillingChosen = array_fill($minId, $maxId - $minId + 1, false);
$_SESSION['fillingsChosen'] = $isFillingChosen;
?>

<html>
<head>

<link rel="stylesheet" href="style.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
<script src="jquery-3.1.1.min.js"></script>
<script>
	function choosePancake() {
		$.ajax({
			url: "choosePancake.php",
			data: {
				"pancakeId": $(this).attr('id')
			},
			type: 'GET',
			success: function(data) {
				var sent = JSON.parse(data);
				$('#' + sent['id']).siblings().removeClass("chosen");
				$('#' + sent['id']).addClass("chosen");
				$("#temp").html(sent["price"] + " BYN");
				$("#total").html(sent["total"] + " BYN");
			}
		})
	}
	
	function chooseFilling() {
		$.ajax({
			url: "chooseFilling.php",
			data: {
				"fillingId": $(this).attr('id').substr(1)
			},
			type: 'GET',
			success: function(data) {
				var sent = JSON.parse(data);
				$('#f' + sent['id']).toggleClass("chosen");
				$("#tempF").html(sent["price"] + " BYN");
				$("#total").html(sent["total"] + " BYN");
			}
		})
	}
	
	$(document).ready(function () {
            $('.pancake').bind('click', choosePancake);
			$('.filling').bind('click', chooseFilling);
        })
</script>
</head>
<body>

<h1>Добро пожаловать на Pancakes Order!</h1>
<table id="pancakeTable">
<tr><th>Название</th><th>Цена</th></tr>
<?php
while ($row = $set->fetch_assoc()) {
	echo "<tr id=".$row["id"]." class=\"pancake\"><td>".$row["name"]."</td><td>".$row["price"]." BYN</td></tr>";
}
?>
</table>
<br>
Цена: <span id="temp"></span>
<br>
<br>

<table id="fillingTable">
<tr><th>Название</th><th>Цена</th></tr>
<?php
while ($row = $fillings->fetch_assoc()) {
	echo "<tr id='f".$row["id"]."' class=\"filling\"><td>".$row["name"]."</td><td>".$row["price"]." BYN</td></tr>";
}
?>
</table>
<br>
Цена: <span id="tempF"></span>
<br>
<br>
Общая стоимость: <span id="total"></span>

</body>
</html>

