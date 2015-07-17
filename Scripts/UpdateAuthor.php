<?php

$proceed = 'yes';

include 'MySQLFunctions.php';
$reservedID = $_GET['reservedID'];
$kind = $_GET['kind'];
$fileToUpload = $_FILES["fileToUpload"];
$author = $_POST;
$author['AuthorID'] = $reservedID;
$author['BioFile'] = $reservedID . '.html';
$author['PictureFile'] = $reservedID . '.png';

if (isset($_POST["submit"])) {
	// Check for empty fields
	if ($_POST['Author'] == '' || $_POST['email'] == '' || $_POST['Status'] == 'select' || 
	$_POST['Archetype'] == '' || $_POST['Hometown'] == '' || $_POST['BioText'] == '') {
		$proceed = 'no';
		echo 'All fields must be complete.';
	}
	
	if ($proceed == 'yes') {
		$uploadOk = 0;
		// Upload Image if new file has been designated
		if ($fileToUpload['size'] > 0) {
			$uploadOk = UploadImage($fileToUpload, $reservedID, 'author');
		}
		
		// Require Picture if creating a New Author
		if ($kind == 'new') {
			if ($uploadOk == 0) {
				$proceed = 'no';
				echo 'Please select a Profile Picture.';
			}
		}
	}
	
	if ($proceed == 'yes') {
		// Save Bio
		$filepath = '../Content/Authors/' . $author['BioFile'];
		$file = fopen($filepath, "w") or die("Unable to open file!");
		$txt = $_POST['BioText'];
		fwrite($file, $txt);
		fclose($file);
		
		// Create or Update Author
		UpdateAuthor($author, $kind);
		if ($kind == 'new') {
			echo 'Author profile has been created.';
			echo '<script>parent.window.location.reload(true);</script>';
		} else {
			echo 'Author profile has been updated.';
			echo '<script>parent.window.location.reload(true);</script>';
		}
	}
}

if (isset($_POST["delete"])) {
	$status = AuthenticateUser($_POST['userEmail'], $_POST['password']);
	if ($status == 'success') {
		DeleteAuthor($author);
		echo '<script>parent.window.location.reload(true);</script>';
	} else {
		echo 'Authentication Failed :(';
	}
}

?>