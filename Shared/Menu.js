// JavaScript Document

var main = function() {
	$('.login').hide();
	$('.menuOptions').hide();
	$('.options').hide();
	
	var menuIconEven = false;
	
	// Mouse Over Menu Button
	$('.menuIcon').hover(function() {
		$(this).addClass('menuIconHighlighted');
	}, function() {
		$(this).removeClass('menuIconHighlighted');
	});
	
	// Menu Button
	$('.menuIcon').click(function() {
		if(menuIconEven) {
			$('.menuIcon').removeClass('menuIconHighlighted');
			$('.menu').removeClass('menuShadow');
			$('.menu').animate({
			  left: "-200px"
			}, 200);
			$('.page').animate({
			  left: "0px"
			}, 200);
		} else {
			$('.menuIcon').removeClass('menuIconHighlighted');
			$('.menu').addClass('menuShadow');
			$('.menu').animate({
			  left: "0px"
			}, 200);
			$('.page').animate({
			  left: "200px"
			}, 200);
		}
		menuIconEven = !menuIconEven;
	});
	
	// page return
	$('.page').click(function() {
		if(menuIconEven) {
			$('.menuIcon').removeClass('menuIconHighlighted');
			$('.menu').removeClass('menuShadow');
			$('.menu').animate({
			  left: "-200px"
			}, 200);
			$('.page').animate({
			  left: "0px"
			}, 200);
			menuIconEven = !menuIconEven;
		}
	});
	
	// Welcome
	$('.gotIt').click(function() {
		$('.welcome').hide();
		$('.login').show();
	});
	$('.close').click(function() {
		$('.welcome').hide();
		$('.login').show();
	});
	
	// Login
	$('.loginButton').click(function() {
		$('.login').hide();
		$('.menuOptions').show();
	});
}

$(document).ready(main);