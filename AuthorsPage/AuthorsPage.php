<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    
    <title>Little Publishing Company</title>
    
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
		$authors = GetAllAuthors('active');
	?>
    
    <div class="section" align="left">
    
    	<h1 class="infoBlockHeading test">The Authors</h1>
        <div class="blockContainer" align="center">
            <?php
				$size = count($authors);
				for ($i = 0; $i < $size; $i++) {
					//$chapter = GetChapterByID($chapterArray[$i]);
					CreateContentBlock('author', $authors[$i]);
				}
            ?>
        </div>
        <br>
    	
        <!--
    	<div class="content" align="left">
        
        	<div align="center">
            	<br>
            	<div>
                	<img src="../Pictures/group.png" height="250" style="box-shadow: 0px 0px 10px 2px #888888">
                </div>
                <br>
            	<h2>The Authors</h2>
                <br>
            </div>
            
            
            \
        	<h3 class="colapsibleHeading infoBlockHeading">
            	<span class="glyphicon glyphicon-chevron-right"></span>
				Full-Time
            </h3>
            
        	<div class="infoBlock">
                //<?php 
//					$entries = count($authors);
//				
//					for ($i = 0; $i < $entries; $i++) {
//						if ($authors[$i]['Status'] == 'full-time') {
//							CreateContentEntry('author', $authors[$i]);
//						}
//					}
//				?>
            </div>
            
            
            
        	<h3 class="colapsibleHeading infoBlockHeading">
            	<span class="glyphicon glyphicon-chevron-right"></span>
				Part-Time
            </h3>
            
        	<div class="infoBlock">
                //<?php 
//					$entries = count($authors);
//				
//					for ($i = 0; $i < $entries; $i++) {
//						if ($authors[$i]['Status'] != 'full-time') {
//							CreateContentEntry('author', $authors[$i]);
//						}
//					}
//				?>
            </div>
            <br>
        </div> -->
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