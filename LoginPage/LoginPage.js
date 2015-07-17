// JavaScript Document

var main = function() {
	$('.login-btn').click(function() {
		var email = $('#email').val();
		var password = $('#password').val();
		window.location.replace("../UserPage/UserPage.php?email=" + email + "&password=" + password);
	});
	
	$('.test').click(function() {
		alert('test');
	});
}

$(document).ready(main);