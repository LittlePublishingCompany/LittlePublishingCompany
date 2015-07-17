<!doctype html>
<html>

<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="Home.css" rel="stylesheet" type="text/css">
    <script src="Home.js"></script>
    
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
    
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
          
        <div class="item active"><a href="../AboutPage/AboutPage.php">
          <img src="../Pictures/Final_FBCover.png" alt="stories books readers">
          <div class="carousel-caption">
              
          </div></a>
        </div>
          
        <div class="item"><a href="https://www.facebook.com/LittlePublishingCompany">
          <img src="../Pictures/FbCover.png" alt="stories books readers">
          <div class="carousel-caption">
          	
          </div></a>
        </div>
          

          
          
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    
  	<div class="section">
		<?php include '../Shared/CommonSections.php'; ?>
    </div>
    
    <br><br>
        
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>