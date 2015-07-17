// JavaScript Document

var main = function() {
	var fadeTime = 2000;
	var showTime = 4000;
	
	$('div').fadeIn(3000);
	
	setTimeout(function() {
		$('div').fadeOut(fadeTime);
		
		setTimeout(function() {
			window.location.replace("Home/Home.php");
		}, fadeTime);
		
	}, showTime);
}

$(document).ready(main);