<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="UserPage.css" rel="stylesheet" type="text/css">
    <script src="UserPage.js"></script>
    
    <title>Site Management</title>
    
</head>

<body>

<header>
	<?php include '../Shared/Header.html'; ?>
</header>

<div class="menu">
	<?php include '../Shared/Menu.html'; ?>
</div>

<div class="page"> 
	<?php
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$email = $_GET['email'];
		$password = $_GET['password'];
		
		$status = AuthenticateUser($email, $password);
	?>
    <div class="section" align="center">
    	<?php
			if ($status == 'success') {
				// Build the page
				
				$newAuthorID = ReserveID('author');
				$newStoryID = ReserveID('story');
				$newChapterID = ReserveID('chapter');
				$authors = GetAllAuthors('inactive', 'unpublished');
				
				echo'
				<div class="content" align="left">

					<!-- Authors Section -->
					<h3 class="colapsibleHeading infoBlockHeading highlightable">
						<span class="glyphicon glyphicon-chevron-right"></span>
						Site Management
					</h3>
					
					<h3>Authors</h3>
						<div class="infoBlock" style="padding:0px">';
							$authorEntries = count($authors);
							
							// Create author entries
							for ($i = 0; $i < $authorEntries; $i++) {
								$zIndex = $authorEntries - $i;
								CreateContentEntry('author', $authors[$i], '', 'edit', $zIndex);
								CreateEditSection('author', $authors[$i], $email);
								
								// Add story entries if they exist for the author
								$storyEntries = count($authors[$i]['Stories']);
								echo '<div class="infoBlock" style="display:none">';
									echo '<h3>Stories</h3>';
									
									// Create story entries for the author
									for ($j = 0; $j < $storyEntries; $j++) {
										$zIndex = $storyEntries - $j;
										CreateContentEntry('story', $authors[$i]['Stories'][$j], '', 'edit', $zIndex);
										CreateEditSection('story', $authors[$i]['Stories'][$j], $email);
										
										// Add chapter entries if they exist for the story
										$chapterEntries = count($authors[$i]['Stories'][$j]['Chapters']);
										echo '<div class="infoBlock" style="display:none">';
											echo '<h3>Chapters</h3>';
											
											// Create chapter entries for the story
											for ($k = 0; $k < $chapterEntries; $k++) {
												$zIndex = $chapterEntries - $k;
												CreateContentEntry('chapter', $authors[$i]['Stories'][$j]['Chapters']
												[$k], '', 'edit', $zIndex);
												CreateEditSection('chapter', $authors[$i]['Stories'][$j]['Chapters']
												[$k], $email);
												
												echo '<div></div>';
											}
											
											// New entry
											$newChapter['Chapter'] = 'New Chapter';
											$newChapter['ChapterID'] = $newChapterID;
											$newChapter['StoryID'] = $authors[$i]['Stories'][$j]['StoryID'];
											$newChapter['AuthorID'] = $authors[$i]['AuthorID'];
											CreateContentEntry('chapter', $newChapter, 'new', 'edit');
											CreateEditSection('chapter', $newChapter, $email, 'new');
											
										echo '<br></div>';
									}
									
									// New entry
									$newStory['Story'] = 'New Story';
									$newStory['StoryID'] = $newStoryID;
									$newStory['AuthorID'] = $authors[$i]['AuthorID'];
									CreateContentEntry('story', $newStory, 'new', 'edit');
									CreateEditSection('story', $newStory, $email, 'new');
									
								echo '<br></div>';
							}
							
							// New entry
							$newAuthor['Author'] = 'New Author';
							$newAuthor['AuthorID'] = $newAuthorID;
							CreateContentEntry('author', $newAuthor, 'new', 'edit');
							CreateEditSection('author', $newAuthor, $email, 'new');
						echo'
					</div>
				</div>';
			}
			else {
				echo'<br><br>
				<div align="center">
					<div class="col-xs-12 col-sm-6 col-md-4">
					</div>
					<div class="alert alert-danger col-xs-12 col-sm-6 col-md-4" role="alert">
						Authentication failed :(
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4">
					</div>
				</div>';
			}
		?>
        
 	</div>
    <br>
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>