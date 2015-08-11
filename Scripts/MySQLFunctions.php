<?php
	include 'vars.php';

	// Connects to the MySQL database
	function MySQLConnect() {
		$servername = "localhost";
		$username = "root";
		$password = "aequitas"; // remote password
		
		// Create connection
		$conn = new mysqli($servername, $username, $password);
        
		// Check connection
		if ($conn->connect_error) {
            $password = "root";  // local password
            $conn = new mysqli($servername, $username, $password);
            if ($conn->connect_error) {
                die("Connection failed: ".$conn->connect_error);
            } else {
                return $conn;
            }
		} else {
			return $conn;
		}
	}
	
	// Takes a chapterID and returns an array with all the chapter's info
	function GetChapterByID($chapterID) {
		// Connect
		$conn = MySQLConnect();
		
		// Default Return
		$chapter = array(
			'Chapter' => 'Chapter missing',
			'StoryID' => 'StoryID missing',
			'ChapterNumber' => 'ChapterNumber missing',
			'ChapterID' => 'ChapterID missing',
			'File' => 'File missing',
			'SynFile' => 'SynFile missing',
			'ArtFile' => 'ArtFile missing',
			'Story' => 'Story missing',
			'AuthorID' => 'AuthorID missing',
			'Author' => 'Author missing',
			'PublishDate' => 'PublishDate missing',
			'Active' => 'Active missing',
			'Views' => 'Views missing',
			'Viewers' => 'Viewers missing',
		);
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Chapters' table entries
		$sql = 'SELECT * FROM Chapters';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($chapterID == $row['ChapterID']) {
					$chapter['Chapter'] = $row['Chapter'];
					$chapter['StoryID'] = $row['StoryID'];
					$chapter['ChapterNumber'] = $row['ChapterNumber'];
					$chapter['ChapterID'] = $row['ChapterID'];
					$chapter['File'] = $row['ChapterID'] . '.html';
					$chapter['SynFile'] = $row['ChapterID'] . 'syn.html';
					$chapter['ArtFile'] = $row['ChapterID'] . '.png';
					$chapter['PublishDate'] = $row['PublishDate'];
					$chapter['Active'] = $row['Active'];
					$chapter['Views'] = $row['Views'];
					$chapter['Viewers'] = $row['Viewers'];
				}
			}
		}
		
		// Find Story and AuthorID from StoryID
		$sql = 'SELECT * FROM Stories';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($chapter['StoryID'] == $row['StoryID']) {
					$chapter['Story'] = $row['Story'];
					$chapter['AuthorID'] = $row['AuthorID'];
				}
			}
		}
		
		// Find Author from AuthorID
		$sql = 'SELECT * FROM Authors';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($chapter['AuthorID'] == $row['AuthorID']) {
					$chapter['Author'] = $row['Author'];
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		// Return
		return $chapter;
	}
	
	
	// Takes a storyID and returns an array with all the story's info
	function GetStoryByID($storyID, $inactive, $unpublished) {
		// Connect
		$conn = MySQLConnect();
		
		// Default Return
		$story = array(
			'Story' => 'Story missing',
			'StoryID' => 'StoryID missing',
			'AuthorID' => 'AuthorID missing',
			'Author' => 'Author missing',
			'ArtFile' => 'ArtFile missing',
			'SynFile' => 'SynFile missing',
			'Chapters' => 'Chapters missing',
		);
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Stories' table entries
		$sql = 'SELECT * FROM Stories';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($storyID == $row['StoryID']) {
					$story['Story'] = $row['Story'];
					$story['Active'] = $row['Active'];
					$story['PublishDate'] = $row['PublishDate'];
					$story['StoryID'] = $row['StoryID'];
					$story['AuthorID'] = $row['AuthorID'];
					$story['ArtFile'] = $row['StoryID'] . '.png';
					$story['SynFile'] = $row['StoryID'] . 'syn.html';
					$story['Chapters'] = array();
				}
			}
		}
		
		// Find Author from AuthorID
		$sql = 'SELECT * FROM Authors';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($story['AuthorID'] == $row['AuthorID']) {
					$story['Author'] = $row['Author'];
				}
			}
		}
		
		// Find Chapters from StoryID
		$sql = 'SELECT * FROM Chapters';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($story['StoryID'] == $row['StoryID']) {
					$chapter = GetChapterByID($row['ChapterID']);
					if ($inactive == 'inactive') {
						$story['Chapters'][] = $chapter;
					} else {
						if ($chapter['Active'] == 'yes') {
							$story['Chapters'][] = $chapter;
						}
					}
				}
			}
		}
		
		$story['Chapters'] = OrderArray($story['Chapters'], 'ChapterNumber', 'ascending');
		
		// Disconnect
		$conn->close();
		
		// Return
		return $story;
	}
	
	
	// Takes an authorID and returns an array with all the author's info
	function GetAuthorByID($authorID, $inactive, $unpublished) {
		// Connect
		$conn = MySQLConnect();
		
		// Default Return
		$author = array(
			'Author' => 'Author missing',
			'email' => 'email missing',
			'Status' => 'Status missing',
			'Active' => 'Active missing',
			'Archetype' => 'Archetype missing',
			'Birthday' => 'Birthday missing',
			'Hometown' => 'Hometown missing',
			'VideoLink' => 'VideoLink missing',
			'AuthorID' => 'AuthorID missing',
			'PictureFile' => 'PictureFile missing',
			'BioFile' => 'BioFile missing',
			'Stories' => 'Stories missing',
		);
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Authors' table entries
		$sql = 'SELECT * FROM Authors';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($authorID == $row['AuthorID']) {
					$author['Author'] = $row['Author'];
					$author['email'] = $row['email'];
					$author['Status'] = $row['Status'];
					$author['Active'] = $row['Active'];
					$author['Archetype'] = $row['Archetype'];
					$author['Birthday'] = $row['Birthday'];
					$author['Hometown'] = $row['Hometown'];
					$author['VideoLink'] = $row['VideoLink'];
					$author['AuthorID'] = $row['AuthorID'];
					$author['PictureFile'] = $row['AuthorID'] . '.png';
					$author['BioFile'] = $row['AuthorID'] . '.html';
					$author['Stories'] = array();
				}
			}
		}
		
		// Find Stories from AuthorID
		$sql = 'SELECT * FROM Stories';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($author['AuthorID'] == $row['AuthorID']) {
					$story = GetStoryByID($row['StoryID'], $inactive, $unpublished);
					if ($inactive == 'inactive') {
						$author['Stories'][] = $story;
					} else {
						if ($row['Active'] == 'yes') {
							$author['Stories'][] = $story;
						}
					}
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		// Order
		$author['Stories'] = OrderArray($author['Stories'], 'PublishDate', 'descending');
		
		// Return
		return $author;
	}
	
	
	// Returns an array containing all the authors arrays
	function GetAllAuthors($inactive, $unpublished) {
		// Connect
		$conn = MySQLConnect();
		
		// Default Return
		$authors = array();
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Authors' table entries
		$sql = 'SELECT * FROM Authors';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$author = GetAuthorByID($row['AuthorID'], $inactive, $unpublished);
				if ($inactive == 'inactive') {
					$authors[] = $author;
				} else {
					if ($author['Active'] == 'yes') {
						$authors[] = $author;
					}
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		// Return
		return $authors;
	}
	
	
	// Returns an array containing all the stories arrays
	function GetAllStories($inactive, $unpublished) {
		// Connect
		$conn = MySQLConnect();
		
		// Default Return
		$stories = array();
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Authors' table entries
		$sql = 'SELECT * FROM Stories';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$story = GetStoryByID($row['StoryID'], $inactive, $unpublished);
				if ($inactive == 'inactive') {
					$stories[] = $story;
				} else {
					if ($story['Active'] == 'yes') {
						$stories[] = $story;
					}
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		$stories = OrderArray($stories, 'PublishDate', 'descending');
		
		// Return
		return $stories;
	}
	
	
	// Check user login info
	function AuthenticateUser($email, $password) {
		$status = 'failure';
		
		if ($email == '') {
			$email = 'void';
		}
		if ($password == '') {
			$password = 'void';
		}
	
		// Connect
		$conn = MySQLConnect();
		
		// Use Users Database
		$conn->query('USE Users');
			
		// Find Accounts table entries
		$sql = 'SELECT * FROM Accounts';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($email == $row['email'] && $password == $row['password']) {
					$status = 'success';
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		return $status;
	}
	
	
	// Returns the lowest available ID number for a new entry
	function ReserveID($type) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Choose Table
		if($type == 'author') {
			$table = 'Authors';
			$IDRef = 'AuthorID';
		} elseif ($type == 'story') {
			$table = 'Stories';
			$IDRef = 'StoryID';
		} elseif ($type == 'chapter') {
			$table = 'Chapters';
			$IDRef = 'ChapterID';
		}
		
		$ID = 0;
		$IDs = array();
			
		// Find table entries
		$sql = 'SELECT * FROM ' . $table;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$IDs[] = $row[$IDRef];
			}
		}
		
		// Find lowest available ID
		$changed = 'yes';
		while ($changed == 'yes') {
			$changed = 'no';
			for ($i = 0; $i < count($IDs); $i++) {
				if ($IDs[$i] == $ID) {
					$ID++;
					$changed = 'yes';
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		return $ID;
	}
	
	// Uploads image to a Content directory based on the type
	function UploadImage($fileToUpload, $reservedID, $type) {
		$uploadOk = 1;
		
		// Choose directory
		if ($type == 'author') {
			$target_dir = "../Content/Authors/";
		} 
		elseif ($type == 'story') {
			$target_dir = "../Content/Stories/";
		} 
		elseif ($type == 'chapter') {
			$target_dir = "../Content/Chapters/";
		} 
		else {
			$uploadOk = 0;
			echo 'Image type unknown.<br>';
		}
		
		// Keeps the same name
		//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$target_file = $target_dir . $reservedID . '.png';
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($fileToUpload["tmp_name"]);
		if($check !== false) {
			//echo "File is an image - " . $check["mime"] . ".<br>";
			$uploadOk = 1;
		} else {
			echo "File is not an image.<br>";
			$uploadOk = 0;
		}
		
		// Check file size
		if ($fileToUpload["size"] > 5000000) {
			echo "Sorry, files must be smaller than 5MB.<br>";
			$uploadOk = 0;
		}
		
		// Allow certain file formats
		if($imageFileType != "png") {
			echo "Sorry, only PNG files are allowed.<br>";
			$uploadOk = 0;
		}
		
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.<br>";
		}
		
		// if everything is ok, try to upload file
		else {
			if (move_uploaded_file($fileToUpload["tmp_name"], $target_file)) {
				//echo "The file ". basename( $fileToUpload["name"]). " has been uploaded.<br>";
			} else {
				echo "Sorry, there was an error uploading your file.<br>";
				$uploadOk = 0;
			}
		}
		
		return $uploadOk;
	}
	
	
	// Updates or adds Author to the Content database
	function UpdateAuthor($author, $kind) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
			
		// Create SQL command
		if ($kind == 'new') {
			$sql = 'INSERT INTO Authors (Author, email, Status, Active, Archetype, Birthday, Hometown, VideoLink, 
			AuthorID) 
			VALUES ("' . $author['Author'] . '", "' . $author['email'] . '", "' . $author['Status'] . '", 
			"' . $author['Active'] . '", "' . $author['Archetype'] . '", "' . $author['Birthday'] . '", 
			"' . $author['Hometown'] . '", "' . $author['VideoLink'] . '", "' . $author['AuthorID'] . '")';
		} else {
			$sql = 'UPDATE Authors 
			SET Author="' . $author['Author'] . '", email="' . $author['email'] . '", Status="' . $author['Status'] . '", 
			Active="' . $author['Active'] . '", Archetype="' . $author['Archetype'] . '", 
			Birthday="' . $author['Birthday'] . '", Hometown="' . $author['Hometown'] . '", 
			VideoLink="' . $author['VideoLink'] . '" 
			WHERE AuthorID="' . $author['AuthorID'] . '"';
		}
		
		$conn->query($sql);
		
		// Disconnect
		$conn->close();
	}
	
	
	// Updates or adds Story to the Content database
	function UpdateStory($story, $kind) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
			
		// Create SQL command
		if ($kind == 'new') {
			$sql = 'INSERT INTO Stories (Story, Active, PublishDate, StoryID, AuthorID) 
			VALUES ("' . $story['Story'] . '", "' . $story['Active'] . '", "' . $story['PublishDate'] . '", 
			"' . $story['StoryID'] . '", "' . $story['AuthorID'] . '")';
		} else {
			$sql = 'UPDATE Stories 
			SET Story="' . $story['Story'] . '", Active="' . $story['Active'] . '", PublishDate="' . 
			$story['PublishDate'] . '" 
			WHERE StoryID="' . $story['StoryID'] . '"';
		}
		
		$conn->query($sql);
		
		// Disconnect
		$conn->close();
	}
	
	
	// Updates or adds Chapter to the Content database
	function UpdateChapter($chapter, $kind) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
			
		// Create SQL command
		if ($kind == 'new') {
			$sql = 'INSERT INTO Chapters (Chapter, ChapterNumber, PublishDate, Active, ChapterID, StoryID) 
			VALUES ("' . $chapter['Chapter'] . '", "' . $chapter['ChapterNumber'] . '", "' . $chapter['PublishDate'] . '",
			"' . $chapter['Active'] . '", "' . $chapter['ChapterID'] . '", "' . $chapter['StoryID'] . '")';
		} else {
			$sql = 'UPDATE Chapters 
			SET Chapter="' . $chapter['Chapter'] . '", ChapterNumber="' . $chapter['ChapterNumber'] . '", PublishDate="' .
			$chapter['PublishDate'] . '", Active="' . $chapter['Active'] . '" 
			WHERE ChapterID="' . $chapter['ChapterID'] . '"';
		}
		
		$conn->query($sql);
		
		// Disconnect
		$conn->close();
	}
	
	
	// Creates a content entry based on the type and info passed to it
	function CreateContentEntry($type, $info, $kind, $permission, $zIndex) {
		if ($type == 'author') {
			$path = '../Content/Authors/';
			$page = 'AuthorPage';
			$id = 'AuthorID';
			$name = 'Author';
			$filename = 'BioFile';
			$pictureFile = 'PictureFile';
			
			if ($permission != 'edit') {
				echo '<a href="../AuthorPage/AuthorPage.php?authorID=' . $info[$id] . '">';
			}
			echo '<div class="contentEntry highlightable colapsibleHeading" style="z-index:' . $zIndex . '">';
				echo '<div class="art edit-btn" style="background-image:url(';
					if ($kind == 'new') {
						echo '../Pictures/plus.png';
					} else {
						echo $path . $info[$pictureFile];
					}
					echo ')">';
				echo '</div>';
				echo '<div class="left" style="right:200px">';
					echo '<h3><a href="../' . $page . '/' . $page . '.php?' . $type . 'ID=' . 
					$info[$id] . '">' . $info[$name] . '</a></h3>';
				echo '</div>';
				
				if ($permission == 'edit') {
					echo '<div class="mid" align="right">';
						if ($type == 'author' && $kind != 'new') {
							echo '<h5>The ' . $info['Archetype'] . '</h5>';
						} else {
							$file = $path . $info[$filename];
							include $file;
						}
					echo '</div>';
					
					echo '<div class="right edit-btn btn ';
						if ($kind == 'new') {
							echo 'btn-info"><h6>Add';
						} else {
							echo 'btn-warning"><h6>Edit';
						}
						echo'</h6>';
					echo '</div>';
				} else {
					echo '<div class="right">';
						echo '<h6>The ' . $info['Archetype'] . '</h6>';
					echo '</div>';
				}
			echo '</div>';
			if ($permission != 'edit') {
				echo '</a>';
			}
		}
		if ($type == 'story') {
			$path = '../Content/Stories/';
			$page = 'StoryPage';
			$id = 'StoryID';
			$name = 'Story';
			$filename = 'SynFile';
			$pictureFile = 'ArtFile';
			
			if ($permission != 'edit') {
				echo '<a href="../StoryPage/StoryPage.php?storyID=' . $info[$id] . '">';
			}
			echo '<div class="contentEntry highlightable colapsibleHeading" style="z-index:' . $zIndex . '">';
				echo '<div class="art edit-btn" style="background-image:url(';
					if ($kind == 'new') {
						echo '../Pictures/plus.png';
					} else {
						echo $path . $info[$pictureFile];
					}
					echo ')">';
				echo '</div>';
				echo '<div class="left">';
					echo '<h3><a href="../' . $page . '/' . $page . '.php?' . $type . 'ID=' . 
					$info[$id] . '">' . $info[$name] . '</a></h3>';
				echo '</div>';
				
				echo '<div class="mid" align="right">';
					$file = $path . $info[$filename];
					include $file;
				echo '</div>';
				
				if ($permission == 'edit') {
					echo '<div class="right edit-btn btn ';
						if ($kind == 'new') {
							echo 'btn-info"><h6>Add';
						} else {
							echo 'btn-warning"><h6>Edit';
						}
						echo'</h6>';
					echo '</div>';
				} else {
					echo '<div class="right">';
						echo '<h6>' . count($info['Chapters']) . '&nbsp; Chapter'; 
						if (count($info['Chapters']) != 1) {
							echo 's';
						}
						echo'</h6>';
					echo '</div>';
				}
			echo '</div>';
			if ($permission != 'edit') {
				echo '</a>';
			}
		}
		if ($type == 'chapter') {
			$path = '../Content/Chapters/';
			$page = 'ChapterPage';
			$id = 'ChapterID';
			$name = 'Chapter';
			$filename = 'SynFile';
			$pictureFile = 'ArtFile';
			
			if ($permission != 'edit') {
				echo '<a href="../ChapterPage/ChapterPage.php?chapterID=' . $info[$id] . '">';
			}
			echo '<div class="contentEntry highlightable colapsibleHeading underline" style="z-index:' . $zIndex . '">';
				echo '<div class="art edit-btn" style="background-image:url(';
					if ($kind == 'new') {
						echo '../Pictures/plus.png';
					} else {
						echo $path . $info[$pictureFile];
					}
					echo ')">';
				echo '</div>';
				echo '<div class="left">';
					echo '<h3><a href="../' . $page . '/' . $page . '.php?' . $type . 'ID=' . 
					$info[$id] . '">' . $info[$name] . '</a></h3>';
				echo '</div>';
				
				echo '<div class="mid" align="right">';
					$file = $path . $info[$filename];
					include $file;
				echo '</div>';
				
				if ($permission == 'edit') {
					echo '<div class="right edit-btn btn ';
						if ($kind == 'new') {
							echo 'btn-info"><h6>Add';
						} else {
							echo 'btn-warning"><h6>Edit';
						}
						echo'</h6>';
					echo '</div>';
				} else {
					echo '<div class="right">';
						$date = date_create($info['PublishDate']);
						echo '<h6>' . date_format($date, "n/j/Y") . '</h6>';
					echo '</div>';
				}
			echo '</div>';
			if ($permission != 'edit') {
				echo '</a>';
			}
		}
	}
	
	
	// Creates edit section based on the type and info passed to it
	function CreateEditSection($type, $info, $userEmail, $kind) {
		if ($type == 'author') {
			$path = '../Content/Authors/';
			$page = 'AuthorPage';
			$id = 'AuthorID';
			$name = 'Author';
			$filename = 'BioFile';
			$pictureFile = 'PictureFile';
			$script = 'UpdateAuthor';
		}
		if ($type == 'story') {
			$path = '../Content/Stories/';
			$page = 'StoryPage';
			$id = 'StoryID';
			$name = 'Story';
			$filename = 'SynFile';
			$pictureFile = 'ArtFile';
			$script = 'UpdateStory';
		}
		if ($type == 'chapter') {
			$path = '../Content/Chapters/';
			$page = 'ChapterPage';
			$id = 'ChapterID';
			$name = 'Chapter';
			$filename = 'SynFile';
			$pictureFile = 'ArtFile';
			$script = 'UpdateChapter';
		}
		
		if ($type == 'author') {
			echo '
			<div style="display: none" class="editSection">	
				<form action="../Scripts/' . $script . '.php?reservedID=' . $info[$id] . '&kind=' . $kind . '" 
				method="post" enctype="multipart/form-data" target="' . $type . 'Response' . $info[$id] . '">
					<label>Profile Picture:</label>&nbsp;<input type="file" name="fileToUpload" id="fileToUpload">
					<label>' . $name . ' ID:&nbsp;</label>' . $info[$id] . '&nbsp;&nbsp;
					<br>
					<label>Name: &nbsp;</label><input type="text" name="Author"';
					if ($kind != 'new') {
						echo ' value="' . $info['Author'] . '"';
					}
					echo '>
					<label>&nbsp; email: &nbsp;</label><input type="text" name="email" value="' . $info['email'] . '">
					<label>&nbsp; Birthday: &nbsp;</label><input type="date" name="Birthday" placeholder="yyyy-mm-dd" 
					value="' . $info['Birthday'] . '">
					<br>
					<label>Status:</label>
					<select name="Status">
						<option value="select">select</option>';
						if ($info['Status'] == 'full-time') {
							echo '<option value="full-time" selected>Full-Time</option>';
							echo '<option value="part-time">Part-Time</option>';
						} else {
							echo '<option value="full-time">Full-Time</option>';
							echo '<option value="part-time" selected>Part-Time</option>';
						}
						echo'
					</select>
					
					<label>&nbsp; Active:</label>
					<select name="Active">';
						if ($info['Active'] == 'yes') {
							echo '<option value="no">No</option>';
							echo '<option value="yes" selected>Yes</option>';
						} else {
							echo '<option value="no" selected>No</option>';
							echo '<option value="yes">Yes</option>';
						}
						echo'
					</select>
					
					<label>&nbsp; Archetype: &nbsp;</label><p style="display: inline-block">The &nbsp;</p>
					<input type="text" name="Archetype" value="' . $info['Archetype'] . '">
					<br>
					
					<label>Hometown: &nbsp;</label><input type="text" placeholder="City, State" name="Hometown" 
					value="' . $info['Hometown'] . '">
					
					<label>&nbsp; Video Link: &nbsp;</label><input type="text" name="VideoLink" 
					value="' . $info['VideoLink'] . '">
					<br>';
					
					$file = $path . $info[$filename];
					$contents = file_get_contents($file);
					
					echo'
					<label>Biography:</label><br><textarea name="BioText" rows="4" cols="110">' . 
					htmlentities($contents) . '</textarea>
					<br>
					
					<input type="submit" value="'; 
					if ($kind == 'new') {
						echo 'Create Author" name="submit" class="btn btn-success">';
					} else {
						echo 'Save Changes" name="submit" class="btn btn-warning">';
					}
					
					if ($kind != 'new') {
						echo'&nbsp; <input type="submit" value="Delete Author" name="delete" class="' . 
						$info[$id] . ' btn btn-danger" id="author" alt="' . $info[$id] . '">';
					}
					echo'
					<input type="text" name="password" class="password' . $info[$id] . '" style="display:none">
					<input type="text" name="userEmail" value="' . $userEmail . '"  style="display:none">
					<iframe name="' . $type . 'Response' . $info[$id] . '" frameborder="0" height="30"></iframe>
				</form>
			</div>';
		}
		
		if ($type == 'story') {
			echo '
			<div style="display: none" class="editSection">	
				<form action="../Scripts/' . $script . '.php?reservedID=' . $info[$id] . '&authorID=' . 
				$info['AuthorID'] . '&kind=' . $kind . '" method="post" enctype="multipart/form-data" 
				target="' . $type . 'Response' . $info['StoryID'] . $info['AuthorID'] . '">
					<label>Art:</label>&nbsp;<input type="file" name="fileToUpload" id="fileToUpload">
					<label>' . $name . ' ID:&nbsp;</label>' . $info[$id] . '&nbsp;&nbsp;
					<label>&nbsp; &nbsp; &nbsp; Author ID:&nbsp;</label>' . $info['AuthorID'] . '&nbsp;&nbsp;
					<br>
					<label>Title: &nbsp;</label><input type="text" name="Story"';
					if ($kind != 'new') {
						echo ' value="' . $info['Story'] . '"';
					}
					echo '>
					<label>&nbsp; Publish Date: &nbsp;</label><input type="date" name="PublishDate" 
					placeholder="yyyy-mm-dd 23:59:59" value="' . $info['PublishDate'] . '">
					
					<label>&nbsp; Active:</label>
					<select name="Active">';
						if ($info['Active'] == 'yes') {
							echo '<option value="no">No</option>';
							echo '<option value="yes" selected>Yes</option>';
						} else {
							echo '<option value="no" selected>No</option>';
							echo '<option value="yes">Yes</option>';
						}
						echo'
					</select>
					<br>';
					
					$file = $path . $info[$filename];
					$contents = file_get_contents($file);
					
					echo'
					<label>Synopsis:</label><br><textarea name="SynText" rows="4" cols="100">' . 
					htmlentities($contents) . '</textarea>
					<br>
					
					<input type="submit" value="'; 
					if ($kind == 'new') {
						echo 'Create Story" name="submit" class="btn btn-success">';
					} else {
						echo 'Save Changes" name="submit" class="btn btn-warning">';
					}
					
					if ($kind != 'new') {
						echo'&nbsp; <input type="submit" value="Delete Story" name="delete" class="' . 
						$info[$id] . ' btn btn-danger" id="story" alt="' . $info[$id] . '">';
					}
					echo'
					<input type="text" name="password" class="password' . $info[$id] . '" style="display:none">
					<input type="text" name="userEmail" value="' . $userEmail . '"  style="display:none">
					<iframe name="' . $type . 'Response' . $info['StoryID'] . $info['AuthorID'] . '" 
					frameborder="0" height="30"></iframe>
				</form>
			</div>';
		}

		if ($type == 'chapter') {
			echo '
			<div style="display: none" class="editSection">	
				<form action="../Scripts/' . $script . '.php?reservedID=' . $info[$id] . '&authorID=' . 
				$info['AuthorID'] . '&storyID=' . $info['StoryID'] . '&kind=' . $kind . '" 
				method="post" enctype="multipart/form-data" target="' . $type . 'Response' . $info['ChapterID'] . 
				$info['StoryID'] . $info['AuthorID'] . '">
					<label>Art:</label>&nbsp;<input type="file" name="fileToUpload" id="fileToUpload">
					<label>' . $name . ' ID:&nbsp;</label>' . $info[$id] . '&nbsp;&nbsp;
					<label>&nbsp; &nbsp; &nbsp; Story ID:&nbsp;</label>' . $info['StoryID'] . '&nbsp;&nbsp;
					<label>&nbsp; &nbsp; &nbsp; Author ID:&nbsp;</label>' . $info['AuthorID'] . '&nbsp;&nbsp;
					<br>
					<label>Title: &nbsp;</label><input type="text" name="Chapter"';
					if ($kind != 'new') {
						echo ' value="' . $info['Chapter'] . '"';
					}
					echo '  size="8">
					
					<label>&nbsp; Chapter #: &nbsp;</label><input type="text" name="ChapterNumber" value="' . 
					$info['ChapterNumber'] . '" size="1">';
					
					//$lowerLimit = 1;
//					
//					if ($kind == 'new') {
//						// Find lowest unused chapter number for the story
//						$story = GetStoryByID($info['StoryID']);
//						$number = 1;
//						for ($i = 0; $i < count ($story['Chapters']); $i++) {
//							if ($story['Chapters'][$i]['ChapterNumber'] == $number) {
//								$number++;
//							}
//						}
//					} else {
//						$number = $info['ChapterNumber'];
//					}
//					
//					
//					// Find 
//					$upperLimit = '';
//					
//					
//					echo'
//					<label>&nbsp; Chapter #:</label>
//					<select name="test">
//						<option value="no">No</option>
//						<option value="yes" selected>Yes</option>
//					</select>
					
					echo'
					<label>&nbsp; Publish Date: &nbsp;</label><input type="date" name="PublishDate" 
					placeholder="yyyy-mm-dd 23:59:59" value="' . $info['PublishDate'] . '" size="18">
					
					<label>&nbsp; Active:</label>
					<select name="Active">';
						if ($info['Active'] == 'yes') {
							echo '<option value="no">No</option>';
							echo '<option value="yes" selected>Yes</option>';
						} else {
							echo '<option value="no" selected>No</option>';
							echo '<option value="yes">Yes</option>';
						}
						echo'
					</select>
					
					<br>';
					
					$file = $path . $info[$filename];
					$contents = file_get_contents($file);
					
					echo'
					<label>Synopsis:</label><br><textarea name="SynText" rows="2" cols="100">' . 
					htmlentities($contents) . '</textarea>
					<br>';
					
					$file = $path . $info['File'];
					$contents = file_get_contents($file);
					
					echo'
					<label>Chapter Text:</label><br><textarea name="Text' . $info['ChapterID'] . '" 
					rows="4" cols="100">' . 
					htmlentities($contents) . '</textarea>
					
					<script>
						
						
						CKEDITOR.replace("Text' . $info['ChapterID'] . '",
						{
							contentsCss: "../Shared/editor.css"
						});
						
					</script>
					
					<input type="submit" value="'; 
					if ($kind == 'new') {
						echo 'Create Chapter" name="submit" class="btn btn-success">';
					} else {
						echo 'Save Changes" name="submit" class="btn btn-warning">';
					}
					
					if ($kind != 'new') {
						echo'&nbsp; <input type="submit" value="Delete Chapter" name="delete" class="' . 
						$info[$id] . ' btn btn-danger" id="chapter" alt="' . $info[$id] . '">';
					}
					echo'
					<input type="text" name="password" class="password' . $info[$id] . '" style="display:none">
					<input type="text" name="userEmail" value="' . $userEmail . '"  style="display:none">
					<iframe name="' . $type . 'Response' . $info['ChapterID'] . $info['StoryID'] . $info['AuthorID'] . '" 
					frameborder="0" height="30"></iframe>
				</form>
			</div>';
		}
	}
	
	
	// Deletes author based on the id passed to it
	function DeleteAuthor($author) {
		// Delete all Chapters then Stories belonging to the Author
		$fullAuthor = GetAuthorByID($author['AuthorID']);
		$storyEntries = count($fullAuthor['Stories']);
		for ($i = 0; $i < $storyEntries; $i++) {
			$chapterEntries = count($fullAuthor['Stories'][$i]['Chapters']);
			for ($j = 0; $j < $chapterEntries; $j++) {
				// Delete any Chapters belonging to the Story
				DeleteChapter($fullAuthor['Stories'][$i]['Chapters'][$j]);
			}
			// Delete the Story
			DeleteStory($fullAuthor['Stories'][$i]);
		}
		
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
			
		// Find Authors table entries
		$sql = 'DELETE FROM Authors WHERE AuthorID="' . $author['AuthorID'] . '"';
		
		$conn->query($sql);
		
		// Delete Files
		$path = '../Content/Authors/';
		$pictureFile = $path . $author['PictureFile'];
		$bioFile = $path . $author['BioFile'];
		unlink($pictureFile);
		unlink($bioFile);
		
		// Feedback
		echo 'Author has been deleted.';
		
		// Disconnect
		$conn->close();
	}
	
	
	// Deletes author based on the id passed to it
	function DeleteChapter($chapter) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
			
		// Delete Chapter database entry
		$sql = 'DELETE FROM Chapters WHERE ChapterID="' . $chapter['ChapterID'] . '"';
		
		$conn->query($sql);
		
		// Delete Chapter Files
		$path = '../Content/Chapters/';
		$artFile = $path . $chapter['ArtFile'];
		$synFile = $path . $chapter['SynFile'];
		$file = $path . $chapter['File'];
		unlink($artFile);
		unlink($synFile);
		unlink($file);
		
		// Feedback
		echo 'Chapter has been deleted.';
		
		// Disconnect
		$conn->close();
	}
	
	
	// Deletes author based on the id passed to it
	function DeleteStory($story) {
		// Delete any Chapters belonging to this Story
		$fullStory = GetStoryByID($story['StoryID']);
		$entries = count($fullStory['Chapters']);
		for ($i = 0; $i < $entries; $i++) {
			DeleteChapter($fullStory['Chapters'][$i]);
		}
		
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
			
		// Find Authors table entries
		$sql = 'DELETE FROM Stories WHERE StoryID="' . $story['StoryID'] . '"';
		
		$conn->query($sql);
		
		// Delete Files
		$path = '../Content/Stories/';
		$artFile = $path . $story['ArtFile'];
		$synFile = $path . $story['SynFile'];
		unlink($artFile);
		unlink($synFile);
		
		// Feedback
		echo 'Story has been deleted.';
		
		// Disconnect
		$conn->close();
	}
	
	// Orders an array based on attribute
	function OrderArray($array, $attribute, $direction) {
		$size = count($array);
		$start = 0;
		$lowestIndex = $start;
		
		while($start < $size) {
			for ($i = $start+1; $i < $size; $i++) {
				if ($direction == 'ascending') {
					if ($array[$i][$attribute] < $array[$lowestIndex][$attribute]) {
						$lowestIndex = $i;
					}
				}
				if ($direction == 'descending') {
					if ($array[$i][$attribute] > $array[$lowestIndex][$attribute]) {
						$lowestIndex = $i;
					}
				}
			}
			$holder = $array[$start];
			$array[$start] = $array[$lowestIndex];
			$array[$lowestIndex] = $holder;
			$start++;
			$lowestIndex = $start;
		}
		return $array;
	}
	
	
	// Creates a content block based on the type and info passed to it
	function CreateContentBlock($type, $info) {
		if ($type == 'chapter') {
			$chapterPath = '../Content/Chapters/';
			$story = GetStoryByID($info['StoryID']);
			echo '<a href="../ChapterPage/ChapterPage.php?chapterID=' . $info['ChapterID'] . '">';
				echo '<div class="block" align="left" 
				style="background-image:url(' . $chapterPath . $info['ArtFile'] . ')">';
					echo '<h2>' . $info['Chapter'] . '</h2>';
					
					echo '<h4>by ' . $info['Author'] . '</h4>';
					
					if (count($story['Chapters']) > 1) {
						echo '<p>from</p>';
						echo '<h3>' . $info['Story'] . '</h3>';
						
					}
					$synFile = $chapterPath . $info['SynFile'];
					include $synFile;
				echo '</div>';
			echo '</a>';
		}
		
		if ($type == 'author') {
			$path = '../Content/Authors/';
			$story = GetAuthorByID($info['AuthorID']);
			echo '<a href="../AuthorPage/AuthorPage.php?authorID=' . $info['AuthorID'] . '">';
				echo '<div class="block" align="left" 
				style="background-image:url(' . $path . $info['PictureFile'] . ')">';
					echo '<h2>' . $info['Author'] . '</h2>';
					echo '<h4>The ' . $info['Archetype'] . '</h4>';
				echo '</div>';
			echo '</a>';
		}
	}
	
	
	// Adds one to the view counter for the chapterID passed to it
	function OneMoreView($chapterID) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Chapters' table entries
		$sql = 'SELECT * FROM Chapters';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($chapterID == $row['ChapterID']) {
					$views = $row['Views'];
					$views++;
					$sql = 'UPDATE Chapters SET Views="' . $views . '" WHERE ChapterID="' . $chapterID . '"';
					$conn->query($sql);
				}
			}
		}
		
		// Disconnect
		$conn->close();
	}
	
	// Keeps track of unique viewers for chapters
	function AddViewer($ip, $chapterID) {
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Users');
		
		// Find 'Chapters' table entries
		$match = 'no';
		$sql = 'SELECT * FROM Viewers';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($ip == $row['IP'] && $chapterID == $row['ChapterID']) {
					$match = 'yes';
				}
			}
		}
		
		if ($match == 'no') {
			// Add viewer IP address
			$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
			date_default_timezone_set('America/Chicago');
			$date = date('Y-m-d G:i:s', time());
			
			$sql = 'INSERT INTO Viewers (IP, ChapterID, City, Region, Country, Org, DateTime) 
			VALUES ("' . $ip . '", "' . $chapterID . '", "' . $details->city . '", "' . 
			$details->region . '", "' . $details->country . '", "' . $details->org . '", "' . $date . '")';
			
			$conn->query($sql);
			
			// Add viewer to chapter
			$conn->query('USE Content');
			$sql = 'SELECT * FROM Chapters';
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if ($chapterID == $row['ChapterID']) {
						$viewers = $row['Viewers'];
						$viewers++;
						$sql = 'UPDATE Chapters SET Viewers="' . $viewers . '" WHERE ChapterID="' . $chapterID . '"';
						$conn->query($sql);
					}
				}
			}
		}
		
		// Disconnect
		$conn->close();
	}
	
	// Attempts to ge the real user IP address
	function GetUserIP() {
		if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
				$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
				return trim($addr[0]);
			} else {
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		else {
			return $_SERVER['REMOTE_ADDR'];
		}
	}
	
	
	// Check if a date has passed
	function HasPassed($date) {
		date_default_timezone_set('America/Chicago');
		$now = date('Y-m-d H:i:s', time());
		
		if ($now > $date) {
			return true;
		} else {
			return false;
		}
	}
	
	// Finds chapters published within the given date range that are also active
	function FindPublishedChapters($startDate, $endDate) {
		$publishedChapters = array();
		
		// Connect
		$conn = MySQLConnect();
		
		// Use Content Database
		$conn->query('USE Content');
		
		// Find 'Chapters' table entries
		$sql = 'SELECT * FROM Chapters';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				if ($row['PublishDate'] >= $startDate && $row['PublishDate'] < $endDate && $row['Active'] == 'yes') {
					$publishedChapters[] = GetChapterByID($row['ChapterID']);
				}
			}
		}
		
		// Disconnect
		$conn->close();
		
		$publishedChapters = OrderArray($publishedChapters, 'PublishDate', 'descending');
		
		return $publishedChapters;
	}
	
	
	// Get a date range based on the inputs
	function WeekDateRange($which, $day, $time) {
		date_default_timezone_set('America/Chicago');
			
		$nowDateTime = date('Y-m-d H:i:s', time());
		$nowTime = date('H:i:s', time());
		
		$today = date('l', strtotime('today'));
		
		$time = strtotime($time);
		$time = date('H:i:s', $time);
		
		$thisWeekStart = date('Y-m-d', strtotime('last ' . $day));
		if ($today == $day && $nowTime > $time) {
			$thisWeekStart = date('Y-m-d', strtotime('today'));
		}
		
		$thisWeekStart = $thisWeekStart . ' ' . $time;
		$thisWeekStart = strtotime($thisWeekStart);
		$thisWeekStart = date('Y-m-d H:i:s', $thisWeekStart);
		
		$lastWeekStart = strtotime($thisWeekStart . ' -7 days');
		$lastWeekStart = date('Y-m-d H:i:s', $lastWeekStart);
		
		
		$launchDate = strtotime('2015-03-20 08:00:00');
		$launchDate = date('Y-m-d H:i:s', $launchDate);
        
        $olderStart = strtotime($thisWeekStart . ' -21 days');
		$olderStart = date('Y-m-d H:i:s', $olderStart);
        
		
		if ($which == 'current') {
			$dateRange = array(
				'startDate' => $thisWeekStart,
				'endDate' => $nowDateTime,
			);
		}
		if ($which == 'last') {
			$dateRange = array(
				'startDate' => $lastWeekStart,
				'endDate' => $thisWeekStart,
			);
		}
		if ($which == 'older') {
			$dateRange = array(
				'startDate' => $olderStart,
				'endDate' => $lastWeekStart,
			);
		}
		
		return $dateRange;
	}
?>