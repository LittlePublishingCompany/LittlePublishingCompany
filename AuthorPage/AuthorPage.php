<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="AuthorPage.css" rel="stylesheet" type="text/css">
    
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
        	<h3 class="colapsibleHeading infoBlockHeading highlightable">
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
            <h3 class="colapsibleHeading infoBlockHeading highlightable">
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
					echo '<h3 class="colapsibleHeading infoBlockHeading highlightable">
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
				$numberOfStories = count($author['Stories']);
				
				if ($numberOfStories > 0) {
					echo '<h3 class="colapsibleHeading infoBlockHeading highlightable">
						<span class="glyphicon glyphicon-chevron-right"></span>
						Stories
					</h3>';
					
					echo '<div class="infoBlock">';
						$entries = count($author['Stories']);
						for ($i = 0; $i < $entries; $i++) {
							$zIndex = $entries - $i;
							CreateContentEntry('story', $author['Stories'][$i], '', '', $zIndex);
						}
					echo'</div>';
				}
            ?>
            <br>
        </div>
 	</div>
    
    <div align="center">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- First Ad -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:728px;height:90px"
             data-ad-client="ca-pub-5604793780709224"
             data-ad-slot="9856222395"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    
    <br><br>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>
