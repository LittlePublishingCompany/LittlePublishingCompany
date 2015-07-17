<?php
	include 'MySQLFunctions.php';
	
	// Create a date time from string
	$time = strtotime('2015-03-25 10:55:59');
	$startDate = date('Y-m-d H:i:s', $time);
	
	$time = strtotime('2015-03-31 23:55:59');
	$endDate = date('Y-m-d H:i:s', $time);
	
	echo '<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>';
?>