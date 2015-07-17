<!doctype html>
<html>
<head>
    
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="ChapterPage.css" rel="stylesheet" type="text/css">
    <script src="ChapterPage.js"></script>
    
    <?php
		$chapterID = $_GET['chapterID'];
		$ip = GetUserIP();
		$chapter = GetChapterByID($chapterID);
		$story = GetStoryByID($chapter['StoryID']);
		
		if (HasPassed($chapter['PublishDate'])) {
			OneMoreView($chapterID);
			AddViewer($ip, $chapterID);
		}
		
		echo '<title>' . $chapter['Chapter'] . '</title>';
		echo '<meta name="title" content="' . $story['Story'] . ' by ' . $chapter['Author'] . '">';
		$file = $chapterPath . $chapter['SynFile'];
		$contents = file_get_contents($file);
		echo '<meta name="description" content="' . htmlentities($contents) . '">';
	?>
    
</head>

<body>

<header>
	<?php include '../Shared/Header.html'; ?>
</header>

<div class="menu">
	<?php include '../Shared/Menu.html'; ?>
</div>

<div class="page">
    
    <div class="section">
    	<div class="screenButtons" align="right">
            <img src="../Pictures/FullScreen.png" height="30" alt=""/ class="fullScreen screenButton" 
            style="display:none">
            <img src="../Pictures/Window.png" height="30" alt=""/ class="windowButton screenButton">
            <div class="btn-group" role="group" aria-label="...">
            	<button type="button" class="btn btn-default fontSizeIncrease">A</button>
            	<button type="button" class="btn btn-default fontSizeDecrease">A</button>
            </div>
        </div>
        
        <ol class="breadcrumb" style="background-color:#E7E7E7; display:inline-block; z-index:3">
          <li>
              <a href="../AuthorPage/AuthorPage.php?authorID=<?php echo $chapter['AuthorID']; ?>">
              	<?php echo $chapter['Author']; ?>
              </a>
          </li>
          <?php
			   if (count($story['Chapters']) > 1) {
				  echo '<li><a href="../StoryPage/StoryPage.php?storyID=' . $chapter['StoryID'] . '">'.$chapter['Story'].'</a></li>';
			   }
		  ?>
          <li class="active"><?php echo $chapter['Chapter']; ?></li>
        </ol>
        
        <?php
			$size = count($story['Chapters']);
			for ($i = 0; $i < $size; $i++) {
				if ($story['Chapters'][$i]['ChapterID'] == $chapter['ChapterID']) {
					$index = $i;
				}
			}
			
			// Previous Chapter
			if ($index > 0) {
				$prevIndex = $index - 1;
				echo '<a href="../ChapterPage/ChapterPage.php?chapterID=' . 
				$story['Chapters'][$prevIndex]['ChapterID'] . '">
					<div class="side leftSide">
					</div>
					<div class="prevChapter">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</div>
				</a>';
			}
			
			// Next Chapter
			if ($index < $size - 1) {
				$nextIndex = $index + 1;
				echo '<a href="../ChapterPage/ChapterPage.php?chapterID=' . 
				$story['Chapters'][$nextIndex]['ChapterID'] . '">
					<div class="side rightSide">
					</div>
					<div class="nextChapter">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</div>
				</a>';
			}
			
			// Views
			echo '<div style="z-index:3"><span class="label label-info">Views: ' . $chapter['Views'] . '</span></div>';
        ?>
        
        
        
        <br>
        <div class="storyBlock">
            <div align="center">
            	<img src="<?php echo $chapterPath . $chapter['ArtFile']; ?>" height="250"  
                style="box-shadow: 0px 0px 10px 2px #888888">
            </div>
            
            <br>
            <?php 
				if (count($story['Chapters']) > 1) {
					//echo '<h2 align="center">
						//Chapter ' . $chapter['ChapterNumber'] . 
					//'</h2>';
				}
			?>
            
            
            <h2 align="center">
				<?php echo $chapter['Chapter']; ?>
            </h2>
            
            <br>
            <?php
				if (count($story['Chapters']) > 1) {
					echo '<p align="center">from</p>';
					echo '<h2 align="center">
            			<a href="../StoryPage/StoryPage.php?storyID=' . $chapter['StoryID'] . '">
					 		' . $chapter['Story'] . 
						'</a>
					</h2>';
				}
            ?>
            
            
            <h3 align="center">
            	by 
                <a href="../AuthorPage/AuthorPage.php?authorID=<?php echo $chapter['AuthorID']; ?>">
					<?php echo $chapter['Author']; ?>
                </a>
            </h3>
            <br>
            <?php
				$file = $chapterPath . $chapter['SynFile'];
				$contents = file_get_contents($file);
				
				echo '<div align="center" style="margin-left:100px; margin-right:100px; 
				white-space: pre-wrap; text-align:center;">';
					echo htmlentities($contents);
				echo '</div>';
			?>
            <br>
            
        	<div class="storyText" align="justify"> 
            	<?php 
					if ($chapter['File'] == 'File missing') {
						echo $chapter['File'];
					} else {
						$file = $chapterPath . $chapter['File'];
						$contents = file_get_contents($file);
						
						if (HasPassed($chapter['PublishDate'])) {
							echo '<div>';
								//echo htmlentities($contents);
								echo $contents;
							echo '</div>';
						} else {
							$date = date_create($chapter['PublishDate']);
							echo '<div align="center">';
								echo 'Check back on ' . date_format($date, "l, F j") . '!';
							echo '</div>';
						}
					}
				?>
            </div>
            <br>
  		</div>
    </div>
    <div align="center">
        <?php
			GenAd('mediumRectangle');
        ?>
    </div>
    
    <br><br>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>