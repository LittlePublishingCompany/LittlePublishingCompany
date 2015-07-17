<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="AboutPage.css" rel="stylesheet" type="text/css">
    
    <title>Little Publishing Company</title>
</head>

<body>

<header>
	<?php include '../Shared/Header.html'; ?>
</header>

<div class="menu">
	<?php include '../Shared/Menu.html'; ?>
</div>
<img src="../Pictures/watermark.png" class="watermark">
<div class="page"> 
	
    <div class="section" align="center">
    	<img src="../Pictures/fulltitlelogo.png" height="300">
    	<!--<h1>Little Publishing Company</h1>-->
        <div class="descriptionText" align="left">
        	
            <h3 class="infoBlockHeading">Why are we here?</h3>
            <br>
            <?php 
                $contents = '	Little Publishing Company is a digital campfire for storytellers and readers to share and discuss stories. This generation is replete with information and inter-connectedness but we are remiss of community and story. We have lost our center. Little Publishing Company’s purpose is to help America rediscover its center by sharing stories worth talking about and creating a vibrant community that examines those stories and, ultimately, life.';
                
                echo '<div style="white-space: pre-wrap; text-align:justify;">';
                    echo htmlentities($contents);
                echo '</div>';
            ?>
            <br>
            <h3 class="infoBlockHeading">What is our mission?</h3>
            <br>
            <?php 
                $contents = '	The Little Publishing Company is dedicated to bringing good stories to readers in an easily accessible format and in lengths that will better serve today’s expedient lifestyles without sacrificing literary quality.';
                
                echo '<div style="white-space: pre-wrap; text-align:justify;">';
                    echo htmlentities($contents);
                echo '</div>';
            ?>
            
        </div>
        <div class="descriptionText" align="justify">
        	<br>
            <h3 class="infoBlockHeading">The People of Little Publishing Company</h3>
            <br>
            <div class="blockContainer" align="center">
				<?php
					$authors = array(
						0 => GetAuthorByID(11),
						1 => GetAuthorByID(0),
						2 => GetAuthorByID(12),
					);
                    $size = count($authors);
                    for ($i = 0; $i < $size; $i++) {
                        CreateContentBlock('author', $authors[$i]);
                    }
					
					echo '<div class="bio">';
						$file = $authorPath . $authors[0]['BioFile'];
						$contents = file_get_contents($file);
						echo htmlentities($contents);
					echo '</div>';
					echo '<div class="bio">';
						$file = $authorPath . $authors[1]['BioFile'];
						$contents = file_get_contents($file);
						echo htmlentities($contents);
					echo '</div>';
					echo '<div class="bio">';
						$file = $authorPath . $authors[2]['BioFile'];
						$contents = file_get_contents($file);
						echo htmlentities($contents);
					echo '</div>';
                ?>
            </div>
        </div>
        <div class="descriptionText" align="justify">
        	<br>
            <?php
				$chapter = GetChapterByID(4);
            ?>
            <h3 class="infoBlockHeading"><?php echo $chapter['Chapter']; ?></h3>
            <br>
            <?php 
				$file = $chapterPath . $chapter['File'];
                $contents = file_get_contents($file);
                
                echo '<div>';
					echo $contents;
				echo '</div>';
            ?>
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