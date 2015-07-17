<!doctype html>
<html>
<head>
	<!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.89">
    
    <title>Bootstrap Practice</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap.css">
    
    <!-- JavaScript -->
    <script src="../jQuery/jquery.js"></script>
    <script src="../bootstrap/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
    <script src="test.js"></script>
    
    <!-- PHP -->
	<?php
        include '../Scripts/MySQLFunctions.php';
        include '../Scripts/Ads.php';
    ?>
</head>

<body>
    <!-- Menu Bar -->
	<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid highlight-bottom">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
            data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color:#F25A3A; padding:4px; padding-left:12px; padding-right: 12px;">
            	<div style="display:inline;"><img src="../Pictures/fire.png" height="42"></div><div style="display:inline; margin-left: 15px">Little Publishing Company</div>
            </a>
          </div>
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#" class="test">Authors<span class="sr-only">(current)</span></a></li>
              <li><a href="#">Stories</a></li>
              <li><a href="#">About</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    
    <div class="page">
    	<div class="section">
            <!-- Testing -->
         	
            <p class="visible-xs">Screen Size: xs</p>
            <p class="visible-sm">Screen Size: sm</p>
            <p class="visible-md">Screen Size: md</p>
            <p class="visible-lg">Screen Size: lg</p>
            
            <p>Margin Formatting:</p>
            
            <!-- Mobile Ads -->
            <div align="center" class="visible-xs visible-sm">
            	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Large Mobile Banner -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:320px;height:100px"
                     data-ad-client="ca-pub-5604793780709224"
                     data-ad-slot="4215570796"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Medium Rectangle -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:300px;height:250px"
                     data-ad-client="ca-pub-5604793780709224"
                     data-ad-slot="9381557599"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Responsive -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-5604793780709224"
                     data-ad-slot="3195423196"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                	<!-- Left Skyscraper Ad -->
                    <div class="col-md-2 col-lg-3  visible-md visible-lg" 
                    style="padding:0px" align="center">
                    	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
                        </script>
                        <!-- Wide Skyscraper -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:160px;height:600px"
                             data-ad-client="ca-pub-5604793780709224"
                             data-ad-slot="2857345995"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    
                    <!-- Center -->
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6" style="padding:0px" 
                    align="center">
                        <div class="textSection" style="">
                        	Addie Mae Collins took Janie’s purse and tossed it to Sarah. The purse was oddly shaped like a football, and they had thrown it the length of their trek: the sisters’ weekly adventure to Sixteenth Street. Their adventure usually lasted twenty minutes, but this morning they were late.
    Earlier that morning, Addie, a quiet child, argued savagely with their eldest sister Junie. Junie had borrowed Addie’s ring for the school dance, and when Addie asked back for it that morning Junie said it was misplaced and she would find it later. Addie knew what that meant, as do all little poor girls. It was lost. A priceless gift, given by her mother, was lost. Addie and Junie shouted at one another until Junie, feeling both guilt and anger, deserted her sisters to ride the bus.
    Janie, the second oldest, thought her purse would distract Addie. Its contents rattled, battering against the sidewalk as the girls dropped it. Janie knew a broken bottle of mascara was worth her sister’s happiness. Their twenty-minute walk became forty-five. They were sweating as they reached the church.
    “Whew, hand that back over.” Sarah snapped the purse back to Janie, and Janie caught it and ran into the basement with other two following hotly behind. “Look at us. We’re a mess. Addie, you’re all sweaty, and look at your hair, Sarah. Your braids are lopsided.”
    They ran into the washroom, taking napkins to dry their sweat. Addie took Sarah’s braids and started straightening them. “Janie, this is going take awhile. You go ahead.”
                        </div>
                    </div>
                    
                    <!-- Right -->
                    <div class="col-md-2 col-lg-3  visible-md visible-lg">
                    </div>
                </div>
            </div>
            
            <p>Headings:</p>
            <div class="heading">Heading</div>
            <br>
            
            <p>Line Entries:</p>
            <div class="lineItem lineItemNeutral highlightable" style="z-index:2">
            	<div class="pic" style="background-image:url(../Pictures/murph.jpg)">
                </div>
                <div class="left">
                	But Thy Eternal Summer Shall Not Fade
                </div>
                <div class="mid visible-sm visible-md visible-lg">
                	synopsis text testing running on and on
                </div>
                <div class="right visible-sm visible-md visible-lg">
                	10/23/15
                </div>
            </div>
            <div class="lineItem lineItemNeutral highlightable" style="z-index:1">
            	<div class="pic">
                </div>
                <div class="left">
                	Just Another Title
                </div>
                <div class="mid visible-sm visible-md visible-lg">
                	More synopsis text. Running on and on and on.
                </div>
                <div class="right visible-sm visible-md visible-lg">
                	1/12/15
                </div>
            </div>
            <br>
            
            <p>Blocks:</p>
            <div class="blockItemContainer">
            	<div class="blockItemWrapper">
                    <a href="#">
                        <div class="blockItem blockItemNeutral highlightable" 
                        style="background-image:url(../Pictures/murph.jpg)">
                        	
                            <h2>But Thy Eternal Summer Shall Not Fade</h2>
                            <h4>by Murphy McLeod Little</h4>
                            <p>from</p>
                            <h3>As Luck Would Have It: An Awkward Tragedy</h3>
                            
                            <p>
                            (3/5) In a late night search for a drink, Jack finds himself thinking of
                            (3/5) In a late night search for a drink, Jack finds himself thinking of
                            (3/5) In a late night search for a drink, Jack finds himself thinking of
                            </p>
                            
                        </div>
                    </a>
                    <a href="#"><div class="blockItem blockItemNeutral highlightable"><h2>Test2</h2></div></a>
                    <a href="#"><div class="blockItem blockItemNeutral highlightable"><h2>Test3</h2></div></a>
                    <a href="#"><div class="blockItem blockItemNeutral highlightable"><h2>Test4</h2></div></a>
                    <a href="#"><div class="blockItem blockItemNeutral highlightable"><h2>Test5</h2></div></a>
                </div>
            </div>
            
        </div>
        
        <div class="footer">
            Little Publishing Company
        </div>
    </div>
    
</body>
</html>