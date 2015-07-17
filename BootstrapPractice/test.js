// JavaScript Document

var main = function() {
	// Highlights
	$('.highlightable').hover(function() {
		// Line Items
		if ( $(this).hasClass('lineItem') ) {
			$(this).removeClass('lineItemNeutral');
			$(this).addClass('lineItemHighlight');
		}
		// Block Items
		if ( $(this).hasClass('blockItem') ) {
			$(this).removeClass('blockItemNeutral');
			$(this).addClass('blockItemHighlight');
		}
	},function() {
		// Line Items
		if ( $(this).hasClass('lineItem') ) {
			$(this).removeClass('lineItemHighlight');
			$(this).addClass('lineItemNeutral');
		}
		// Block Items
		if ( $(this).hasClass('blockItem') ) {
			$(this).removeClass('blockItemHighlight');
			$(this).addClass('blockItemNeutral');
		}
	});
}

$(document).ready(main);