// JavaScript Document

var main = function() {
	
	// Delete Author
	$("#author[name='delete']").click(function() {
		var input = prompt('WARNING: \nAre you sure you want to delete this author? This will delete all information and files related to this author on the server. This includes all Stories and Chapters belonging to this Author. \n\nThis cannot be undone.', 'Re-enter password to proceed');
		
		var str = 'input.password' + $(this).attr('alt');
		$(str).val(input);
	});
	
	// Delete Story
	$("#story[name='delete']").click(function() {
		var input = prompt('WARNING: \nAre you sure you want to delete this Story? This will delete all information and files related to this Story on the server. This includes all Chapters belonging to this Story. \n\nThis cannot be undone.', 'Re-enter password to proceed');
		
		var str = 'input.password' + $(this).attr('alt');
		$(str).val(input);
	});
	
	// Delete Chapter
	$("#chapter[name='delete']").click(function() {
		var input = prompt('WARNING: \nAre you sure you want to delete this Chapter? This will delete all information and files related to this Chapter on the server. \n\nThis cannot be undone.', 'Re-enter password to proceed');
		
		var str = 'input.password' + $(this).attr('alt');
		$(str).val(input);
	});

}

$(document).ready(main);