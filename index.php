<?php require("requires/mainPageGen.php"); ?>

<html>
<head>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
	<script src="src/jquery-3.1.1.min.js"></script>
	<script src="src/mainPageScript.js"></script>
	
	<link rel="stylesheet" href="Styles/bootstrap.min.css">
	<link rel="stylesheet" href="Styles/MainPageStyle.css">
</head>
<body>

<div id="main-div">
	<?php include("Templates/header.php");?>
	
	<div id="main-content-div">
		<h2>Закажите блин в 2 простых шага:</h2><br>
		
		<label>1. Выберите блин:</label>
		<div class="for-table">
			<?php showPancakesTable(); ?>
			
			<span class="for-price">Цена: <span id="temp"></span></span><br>
			<span id='chooseErr' class='err' ></span>
		</div>
		
		<label>2. Выберите начинки:</label>
		<div class="for-table">
			<?php showFillingsTable(); ?>
		
			<span class="for-price"> Цена: <span id="tempF"></span></span>
		</div>	
	</div>
	
	<div class="order-wrap">
		<label>Ваш заказ:</label>
		<div class="order">
			<span class="for-menu-price">Общая стоимость: <span id="total"></span></span>
			<br>
			<h6>Введите ваш пароль:</h6>
			<input id="code" type="text" placeholder="Пароль"><br>
			<span id='passErr' class='err' ></span>
			<br><br>
			<button id="orderBtn" class="btn  btn-primary" >Заказать</button> 
		</div>
	</div>
	
	<?php include("Templates/footer.php");?>
</div>

</body>
</html>

