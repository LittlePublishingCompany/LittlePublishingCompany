<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="ArtistPage.css" rel="stylesheet" type="text/css">
    
    <?php
		$authorID = $_GET['authorID'];
		$author = GetAuthorByID($authorID);
		echo '<title>' . $author['Author'] . '</title>';
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
    	<div class="content" align="left">
        
        	<!-- Author Info Section -->
        	<h3 class="colapsibleHeading infoBlockHeading">
            <span class="glyphicon glyphicon-chevron-right"></span>
			<?php echo $author['Author']; ?>
            </h3>
            
        	<div class="infoBlock">
                <div class="authorPicture">
                    <img src="<?php echo $authorPath . $author['PictureFile']; ?>" height="200">
                </div>
                <div class="authorInfo">
                    <h3>The <?php echo $author['Archetype']; ?></h3>
                    <h3>Born: 
						<?php
							$birthday = date_create($author['Birthday']);
							echo date_format($birthday, "F j, Y");
						?>
                    </h3>
                    <h3>Hometown: <?php echo $author['Hometown']; ?></h3>
                </div>
            </div>
            
            <!-- Biography Section -->
            <h3 class="colapsibleHeading infoBlockHeading">
            	<span class="glyphicon glyphicon-chevron-right"></span>
            	Biography
            </h3>
            
			<?php 
                $file = $authorPath . $author['BioFile']; 
                $contents = file_get_contents($file);
                
                echo '<div class="infoBlock" style="white-space: pre-wrap; text-align:justify;">';
                    echo htmlentities($contents);
                echo '</div>';
            
				// <!-- Video Section -->
				if ($author['VideoLink'] != '') {
					echo '<h3 class="colapsibleHeading infoBlockHeading">
						<span class="glyphicon glyphicon-chevron-right"></span>
						Video
					</h3>';
					
					echo '<div align="center" class="videoContainer infoBlock">
						<iframe width="560" height="315" class="authorVideo" src="' . $author['VideoLink'] . '" 
						frameborder="0" allowfullscreen>
						</iframe>
					</div>';
				}
				
				// <!-- Stories -->
				$numberOfStories = 0;
				$size = count($author['Stories']);
				for ($i = 0; $i < $size; $i++) {
					if ($author['Stories'][$i]['Active'] == 'yes') {
						$numberOfStories++;
					}
				}
				
				if ($numberOfStories > 0) {
					echo '<h3 class="colapsibleHeading infoBlockHeading">
						<span class="glyphicon glyphicon-chevron-right"></span>
						Stories
					</h3>';
					
					echo '<div class="infoBlock">';
						if ($author['Stories'] == 'Stories missing') {
							$entries = 1;
							$author['Stories'][0] = 'Stories missing';
						} else {
							$entries = count($author['Stories']);
						}
					
						for ($i = 0; $i < $entries; $i++) {
							if ($author['Stories'][$i]['Active'] == 'yes') {
								CreateContentEntry('story', $author['Stories'][$i]);
							}
						}
					echo'</div>';
				}
            ?>
            <br>
        </div>
 	</div>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>
