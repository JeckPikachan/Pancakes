var isChosen = false;

function choosePancake() {
	$('#chooseErr').text('');
	$.ajax({
		url: "serverScripts/choosePancake.php",
		data: {
			"pancakeId": $(this).attr('id')
		},
		type: 'GET',
		success: function(data) {
			var sent = JSON.parse(data);
			$('#' + sent['id']).siblings().removeClass("success");
			$('#' + sent['id']).addClass("success");
			$("#temp").html(sent["price"] + " BYN");
			$("#total").html(sent["total"] + " BYN");
			isChosen = true;
		}
	})
}

function chooseFilling() {
	$.ajax({
		url: "serverScripts/chooseFilling.php",
		data: {
			"fillingId": $(this).attr('id').substr(1)
		},
		type: 'GET',
		success: function(data) {
			var sent = JSON.parse(data);
			$('#f' + sent['id']).toggleClass("success");
			$("#tempF").html(sent["price"] + " BYN");
			$("#total").html(sent["total"] + " BYN");
		}
	})
}

function makeOrder() {
	var pass = document.getElementById('code');
	if (!isChosen) {
		$('#chooseErr').text("Вы должны выбрать блин");
	} else if (!(pass.value) || pass.value.length <= 4) {
		$('#passErr').text("Длина пароля должна быть не менее 5 символов");
	} else {
		$.ajax({
			url: "serverScripts/process.php",
			type: 'GET',
			success: function(data) {
				window.location.replace("success.php");
			}
		})
	}
}	

function passwordChanged() {
	var pass = this;
	if (pass.value && pass.value.length > 4) {
		$.ajax({
			url: "serverScripts/changePassword.php",
			data: {
				"code": pass.value
			},
			type: 'GET',
			success: function(data) {
				$("#passErr").text('');
			}
		})
		
	} else {
		$('#passErr').text("Длина пароля должна быть не менее 5 символов");
	}
}

$(document).ready(function () {
        $('.pancake').bind('click', choosePancake);
		$('.filling').bind('click', chooseFilling);
		$('#orderBtn').bind('click', makeOrder);
		$('#code').bind('keyup', passwordChanged);
});