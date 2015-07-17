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
		//$artists = GetAllArtists('active');
	?>
    
    <div class="section" align="left">
    
    	<h1 class="infoBlockHeading test">The Artists</h1>
        <div class="blockContainer" align="center">
            <?php
				$size = count($artists);
				for ($i = 0; $i < $size; $i++) {
					CreateContentBlock('artist', $artists[$i]);
				}
            ?>
        </div>
        <br>
    	
 	</div>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>