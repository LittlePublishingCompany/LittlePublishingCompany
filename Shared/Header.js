// JavaScript Document

var main = function() {
	var menuIconEven = false;
	
	$('.tab').hover(function() {
		$(this).addClass('customHighlight');
	}, function() {
		$(this).removeClass('customHighlight');
	});
}

$(document).ready(main);