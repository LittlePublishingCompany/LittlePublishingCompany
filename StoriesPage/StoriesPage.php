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
		$stories = GetAllStories();
	?>
    
    <div class="section">
        <?php include '../Shared/CommonSections.php'; ?>
        <br>
    	
        <!-- The Archives Section -->
        <h1 class="infoBlockHeading">The Archives</h1>
        
        <br>
        <div style="margin-left:75px; margin-right:75px;">
            <?php 
                $entries = count($stories);
                for ($i = 0; $i < $entries; $i++) {
					$zIndex = $entries - $i;
					CreateContentEntry('story', $stories[$i], '', '', $zIndex);
                }
            ?>
        </div>
        <br>
        <br>
 	</div>
    <br>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>