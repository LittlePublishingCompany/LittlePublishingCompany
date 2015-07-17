// JavaScript Document

var main = function() {
	// Orient Expand/Colapse Arrow Function
	var orientArrow = function(selector) {
		if (selector.next().is(":visible")) {
			selector.find('span').css({
				"-webkit-transform": "rotate(90deg)",
				"-moz-transform": "rotate(90deg)",
				"transform": "rotate(90deg)" /* For modern browsers(CSS3)  */
			});
		} else {
			selector.find('span').css({
				"-webkit-transform": "rotate(0deg)",
				"-moz-transform": "rotate(0deg)",
				"transform": "rotate(0deg)" /* For modern browsers(CSS3)  */
			});
		}
	}
	
	// Change arrow orientation
	var turnArrow = function(selector) {
		if (selector.next().is(":visible")) {
			selector.find('span').css({
				"-webkit-transform": "rotate(0deg)",
				"-moz-transform": "rotate(0deg)",
				"transform": "rotate(0deg)" /* For modern browsers(CSS3)  */
			});
		} else {
			selector.find('span').css({
				"-webkit-transform": "rotate(90deg)",
				"-moz-transform": "rotate(90deg)",
				"transform": "rotate(90deg)" /* For modern browsers(CSS3)  */
			});
		}
	}
	
	// Initial Arrow Orientation
	$('.page').find('.colapsibleHeading').each(function() {
        orientArrow($(this));
    });
	
	// Expand/Colapse options
	$('.colapsibleHeading').click(function() {
		turnArrow($(this));
		$(this).nextAll('.infoBlock').first().slideToggle(400, 'swing');
	});
	
	// highlight
	$('.highlightable').hover(function() {
		$(this).addClass('customHighlight');
	}, function() {
		$(this).removeClass('customHighlight');
	});
	
	// block highlight
	$('.block').hover(function() {
		$(this).addClass('blockHighlight');
	},function() {
		$(this).removeClass('blockHighlight');
	});
	
	// Content Entry Edit Button
	$('.edit-btn').click(function() {
		$(this).parent().nextAll('.editSection').first().slideToggle(400, 'swing');
	});
}

$(document).ready(main);