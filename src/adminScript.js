var orderId;

function mkDone() {
	var id = $(this).closest('tr').attr('id');
	$.ajax({
		url: "serverScripts/mkDone.php",
		data: {
			"id" : id
		},
		type: 'GET',
		success: function(data) {
			var id = "#" + data;
			$(id).removeClass("success");
			$(id).addClass("success");
		}
	});
}

function showModalPass() {
	$('#passModal').css("display", "block");
	orderId = $(this).closest('tr').attr('id');
	$("#passErr").text("");
}

function hideModalPass() {
	$('#passModal').css("display", "none");
}

function mkAllReady() {
	var pass = $("#password").val();
	$.ajax({
		url: "serverScripts/checkPassword.php",
		data: {
			"pass": pass,
			"id": orderId
		},
		type: 'GET',
		success: function(data) {
			var response = data;
			if (!response) $('#passErr').text('неверно введен пароль');
			else {
				$("#passModal").css("display", "none");
				$("#" + orderId).remove();
			}
		}
	});
}

$(document).ready(function () {
	$(".readyBtn").bind('click', mkDone);
	$(".getBtn").bind('click', showModalPass);
	$(".close").bind('click', hideModalPass);
	$("#allReady").bind('click', mkAllReady);
});