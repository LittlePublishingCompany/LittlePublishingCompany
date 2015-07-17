// JavaScript Document

var main = function() {
	// carousel sizing
	var carouselWidth = $('.carousel').width();
	var carouselHeight = carouselWidth*0.37;
	$('.carousel').height(carouselHeight);
	
	// carousel image sizing
	$('.item>img').width('100%');
	$('.item>img').height(carouselHeight);
}

$(document).ready(main);