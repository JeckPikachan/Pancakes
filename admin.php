<?php require("requires/adminPageGen.php"); ?>

<html>
<head>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
	<script src="src/jquery-3.1.1.min.js"></script>
	<script src="src/adminScript.js"></script>
	
	<link rel="stylesheet" href="Styles/bootstrap.min.css">
	<link rel="stylesheet" href="Styles/AdminPageStyle.css">
</head>
<body>
<div id="main-div">
	<?php include("Templates/header.php"); ?>
	
	<?php showOrdersTable(); ?>
	
	<div id="passModal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			Введите пароль: <input id="password" type="text" placeholder="пароль"><span id="passErr" class="err"></span>
			<br>
			<button id="allReady">Готово</button>
		</div>
	</div>
	
	<?php include("Templates/footer.php"); ?>
</div>
</body>
</html>