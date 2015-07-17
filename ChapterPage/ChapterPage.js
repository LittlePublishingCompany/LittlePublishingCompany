// JavaScript Document

var main = function() {
	$('.windowButton').hide();
	
	$('.fullScreen').click(function() {
		$('.menu').hide();
		$('.footer').hide();
		
		$('header').animate({
			top: "-100px"
		}, 200);
		$('.page').animate({
			top: "-100px"
		}, 200);
		$('.windowButton').animate({
			top: "5px"
		}, 200);
		$('.btn-group').animate({
			top: "5px"
		}, 200);
		
		
		$('.fullScreen').hide();
		$('.windowButton').show();
	});
	
	$('.windowButton').click(function() {
		$('.menu').show();
		$('.footer').show();
		
		$('header').animate({
			top: "0px"
		}, 200);
		$('.page').animate({
			top: "0px"
		}, 200);
		$('.windowButton').animate({
			top: "105px"
		}, 200);
		$('.btn-group').animate({
			top: "105px"
		}, 200);
		
		
		$('.fullScreen').show();
		$('.windowButton').hide();
	});
	
	$('.fontSizeIncrease').click(function() {
		$('.storyText').find('span').each(function() {
            var size = parseFloat($(this).css('font-size'));
			if (size < 40) {
				size = size+2;
			}
			$(this).css('font-size', size);
        });
	});
	$('.fontSizeDecrease').click(function() {
		$('.storyText').find('span').each(function() {
            var size = parseFloat($(this).css('font-size'));
			if (size > 8) {
				size = size-2;
			}
			$(this).css('font-size', size);
        });
	});
	
	$('.side').hover(function() {
		$(this).addClass('show', {duration:500});
	}, function() {
		$(this).removeClass('show', {duration:500});
	});
};

$(document).ready(main);