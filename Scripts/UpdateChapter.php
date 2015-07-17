<?php
$proceed = 'yes';

include 'MySQLFunctions.php';
$reservedID = $_GET['reservedID'];
$authorID = $_GET['authorID'];
$storyID = $_GET['storyID'];
$kind = $_GET['kind'];
$fileToUpload = $_FILES["fileToUpload"];
$chapter = $_POST;
$chapter['ChapterID'] = $reservedID;
$chapter['AuthorID'] = $authorID;
$chapter['StoryID'] = $storyID;
$chapter['File'] = $reservedID . '.html';
$chapter['SynFile'] = $reservedID . 'syn.html';
$chapter['ArtFile'] = $reservedID . '.png';

if (isset($_POST["submit"])) {
	// Check for empty fields
	if ($_POST['Chapter'] == '' || $_POST['ChapterNumber'] == '' || $_POST['PublishDate'] == '' || 
	$_POST['SynText'] == '' || $_POST['Text' . $chapter['ChapterID']] == '') {
		$proceed = 'no';
		echo 'All fields must be complete.';
	}
	
	if ($proceed == 'yes') {
		$uploadOk = 0;
		// Upload Image if new file has been designated
		if ($fileToUpload['size'] > 0) {
			$uploadOk = UploadImage($fileToUpload, $reservedID, 'chapter');
		}
		
		// Require Picture if creating a New Chapter
		if ($kind == 'new') {
			if ($uploadOk == 0) {
				$proceed = 'no';
				echo 'Please select a Picture.';
			}
		}
	}
	
	if ($proceed == 'yes') {
		// Save Synopsis
		$filepath = '../Content/Chapters/' . $chapter['SynFile'];
		$file = fopen($filepath, "w") or die("Unable to open file!");
		$txt = $_POST['SynText'];
		fwrite($file, $txt);
		fclose($file);
		
		// Save Chapter Text
		$filepath = '../Content/Chapters/' . $chapter['File'];
		$file = fopen($filepath, "w") or die("Unable to open file!");
		$txt = $_POST['Text' . $chapter['ChapterID']];
		fwrite($file, $txt);
		fclose($file);
		
		// Create or Update Chapter database entry
		UpdateChapter($chapter, $kind);
		if ($kind == 'new') {
			echo 'Chapter has been created.';
			echo '<script>parent.window.location.reload(true);</script>';
		} else {
			echo 'Chapter has been updated.';
			echo '<script>parent.window.location.reload(true);</script>';
		}
	}
}

if (isset($_POST["delete"])) {
	$status = AuthenticateUser($_POST['userEmail'], $_POST['password']);
	if ($status == 'success') {
		DeleteChapter($chapter);
		echo '<script>parent.window.location.reload(true);</script>';
	} else {
		echo 'Authentication Failed :(';
	}
}

?>