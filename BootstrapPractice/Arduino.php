<!doctype html>
<html>
<head>
	<!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Arduino</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../bootstrap/bootstrap-3.3.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="Arduino.css">
    
    <!-- JavaScript -->
    <script src="../jQuery/jquery.js"></script>
    <script src="../jQuery/ping.js"></script>
    <script src="../bootstrap/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
    <script src="Arduino.js"></script>
    
    <!-- PHP -->
	<?php
        //include '';

        // CC3000 IP Address
        $ip = "192.168.1.6";
    ?>
</head>

<body>
    
    <div class="page">
    	<div class="section">
            
            <span id="connectionStatus" class="btn" style="width: 100%"></span><br><br><br><br>
            
            <?php
                echo '<a href="http://' . $ip . '/?test1" class="btn btn-success btn-touch" target="window">ON</a><br><br>';

                echo '<a href="http://' . $ip . '/?test2" class="btn btn-danger btn-touch" target="window">OFF</a>';

                echo '<iframe name="window" src="" style="display: none"></iframe>';
            ?>
        </div>
        
        <div class="footer test1">
            Arduino
        </div>
    </div>
    
</body>
</html>