<?php
	include 'MySQLFunctions.php';
	
	$email = $_POST['email']; 
	$password = $_POST['password'];
	
	$status = AuthenticateUser($email, $password);
	
	// Response
	$response['status'] = json_encode($status);
	echo json_encode($response);
?>