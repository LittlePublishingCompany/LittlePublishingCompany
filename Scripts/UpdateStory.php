<?php
$proceed = 'yes';

include 'MySQLFunctions.php';
$reservedID = $_GET['reservedID'];
$authorID = $_GET['authorID'];
$kind = $_GET['kind'];
$fileToUpload = $_FILES["fileToUpload"];
$story = $_POST;
$story['StoryID'] = $reservedID;
$story['AuthorID'] = $authorID;
$story['SynFile'] = $reservedID . 'syn.html';
$story['ArtFile'] = $reservedID . '.png';

if (isset($_POST["submit"])) {
	// Check for empty fields
	if ($_POST['Story'] == '' || $_POST['PublishDate'] == '' || $_POST['SynText'] == '') {
		$proceed = 'no';
		echo 'All fields must be complete.';
	}
	
	if ($proceed == 'yes') {
		$uploadOk = 0;
		// Upload Image if new file has been designated
		if ($fileToUpload['size'] > 0) {
			$uploadOk = UploadImage($fileToUpload, $reservedID, 'story');
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
		$filepath = '../Content/Stories/' . $story['SynFile'];
		$file = fopen($filepath, "w") or die("Unable to open file!");
		$txt = $_POST['SynText'];
		fwrite($file, $txt);
		fclose($file);
		
		// Create or Update Story
		UpdateStory($story, $kind);
		if ($kind == 'new') {
			echo 'Story has been created.';
			echo '<script>parent.window.location.reload(true);</script>';
		} else {
			echo 'Story has been updated.';
			echo '<script>parent.window.location.reload(true);</script>';
		}
	}
}

if (isset($_POST["delete"])) {
	$status = AuthenticateUser($_POST['userEmail'], $_POST['password']);
	if ($status == 'success') {
		DeleteStory($story);
		echo '<script>parent.window.location.reload(true);</script>';
	} else {
		echo 'Authentication Failed :(';
	}
}

?>