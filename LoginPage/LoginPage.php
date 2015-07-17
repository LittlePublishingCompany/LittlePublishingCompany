<!doctype html>
<html>
<head>
	<!-- Load SharedSetup -->
	<?php include '../Shared/SharedSetup.php'; ?>
    
    <!-- Page Specific Resources -->
    <link href="../LoginPage/LoginPage.css" rel="stylesheet" type="text/css">
    <script src="LoginPage.js"></script>
    
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
    <div class="section" align="center">
    	<br><br>
        <h1 class="test">Login</h1>
        <br>
        <form action="../UserPage/UserPage.php?email=&password=" method="post" enctype="multipart/form-data">
            <input type="email" name="email" placeholder="email" id="email">
            <input type="password" name="password" placeholder="password" id="password">
            <input type="button" value="Login" class="login-btn btn btn-info">
        </form>
        <br>
        <a href="../BootstrapPractice/BootstrapPractice.php">Bootstrap</a>
 	</div>
    
    <div class="footer">
    	<?php include '../Shared/Footer.html'; ?>
    </div>
</div>

</body>
</html>