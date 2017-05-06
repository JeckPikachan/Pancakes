<?php
session_start();
?>

<html>
<head>
<link rel="stylesheet" href="Styles/bootstrap.min.css">
<link rel="stylesheet" href="Styles/successPageStyle.css">
</head>
<body>

<div id="main-div">
	<?php include("Templates/header.php"); ?>
	
	Ваш заказ был успешно обработан<br>
	Номер вашего заказа: 
	<?=$_SESSION["orderId"];?><br>
	<a href="index.php">На главную</a>
	
	<?php include("Templates/footer.php"); ?>
</div>
</body>
</html>