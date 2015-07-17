<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="StoryPage.css" rel="stylesheet" type="text/css">
    
    <?php
		$storyID = $_GET['storyID'];
		$story = GetStoryByID($storyID);
		echo '<title>' . $story['Story'] . '</title>';
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
    
    <div class="section" align="center">
    	<div class="tree" align="left">
			<ol class="breadcrumb" style="background-color:#E7E7E7; display:inline-block">
                <li>
                    <a href="../AuthorPage/AuthorPage.php?authorID=<?php echo $story['AuthorID']; ?>">
                      <?php echo $story['Author']; ?>
                    </a>
                </li>
                <li class="active"><?php echo $story['Story']; ?></li>
            </ol>
        </div>
        
    	<div class="content" align="left">
        	<div align="center">
            	<br>
                
                <div>
            		<img src="<?php echo $storyPath . $story['ArtFile']; ?>" height="250" 
                    style="box-shadow: 0px 0px 10px 2px #888888">
                </div>
                
                <br>
        		<h1 align="center"><?php echo $story['Story']; ?></h1>
        		<h3 align="center">by 
                	<a href="../AuthorPage/AuthorPage.php?authorID=<?php echo $story['AuthorID']; ?>">
						<?php echo $story['Author']; ?>
                    </a>
                </h3>
                <br>
                <?php
					$file = $storyPath . $story['SynFile'];
					$contents = file_get_contents($file);
					
					echo '<div align="center" style="margin-left:100px; margin-right:100px; 
					white-space: pre-wrap; text-align:center;">';
						echo htmlentities($contents);
					echo '</div>';
                ?>
                <br>
            </div>
            
            <!-- Chapters Section -->
        	<h3 class="colapsibleHeading infoBlockHeading highlightable">
            	<span class="glyphicon glyphicon-chevron-right"></span>
				Chapters
            </h3>
            
        	<div class="infoBlock">
                <?php 
					if ($story['Chapters'] == 'Chapters missing') {
						$entries = 1;
						$story['Chapters'][0] = 'Chapters missing';
					} else {
						$entries = count($story['Chapters']);
					}
				
					for ($i = 0; $i < $entries; $i++) {
						$zIndex = $entries - $i;
						CreateContentEntry('chapter', $story['Chapters'][$i], '', '', $zIndex);
					}
				?>
            </div>
            <br>
        </div>
 	</div>
    
    <div align="center">
        <?php GenAd('footer'); ?>
    </div>
    
    <br><br>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>