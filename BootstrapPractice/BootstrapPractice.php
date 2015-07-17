<!doctype html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=0.89">

<title>Bootstrap Practice</title>

<!-- CSS -->
<link rel="stylesheet" href="../bootstrap/bootstrap-3.3.2-dist/css/bootstrap.css">

<!-- JavaScript -->
<script src="../jQuery/jquery.js"></script>
<script src="../bootstrap/bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>

</head>

<body>

	<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
            data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
          </div>
        
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                  <li class="divider"></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Link</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    
    <div style="margin-top:55px">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li><a href="#">Library</a></li>
          <li class="active">Data</li>
        </ol>
    </div>
    
    <div class="container-fluid">
    	<p>Column Span Test:</p>
        <a href="Mobile.php">Mobile Site</a>
        <br><br>
        <div class="row">
            <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3" style="background-color:#E85255; height:100px;">
            </div>
            <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6" style="background-color:#B9B9B9; height:100px;" align="center">
            	<div style="width:100%; max-width:400px; background-color:#ACACAC; height:100%">
                </div>
            </div>
            <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3" style="background-color:#38B8E0; height:100px;">
            </div>
        </div>
    </div>
    
    <br>
    
    <div class="container-fluid">
        <div class="row" style="background-color:#E9E9E9">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <p>Labels:</p>
                <span class="label label-default">Default</span>
                <span class="label label-primary">Primary</span>
                <span class="label label-success">Success</span>
                <span class="label label-info">Info</span>
                <span class="label label-warning">Warning</span>
                <span class="label label-danger">Danger</span>
            </div>
                
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <p>Alerts:</p>
                <div class="alert alert-success" role="alert">Well done! 
                You successfully read this important alert message.
                </div>
                <div class="alert alert-info" role="alert">Heads up! This alert needs your attention, 
                but it's not super important.</div>
                <div class="alert alert-warning" role="alert">Warning! Better check yourself, 
                you're not looking too good.</div>
                <div class="alert alert-danger" role="alert">Oh snap! Change a few things up and try 
                submitting again.</div>
                
                <br>
                <p>Dismissable Alert:</p>
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Warning!</strong> Better check yourself, you're not looking too good.
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <p>Progress Bars:</p>
                <div class="progress">
                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" 
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" 
                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" 
                  aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" 
                  aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-success" style="width: 35%">
                    <span class="sr-only">35% Complete (success)</span>
                  </div>
                  <div class="progress-bar progress-bar-warning progress-bar-striped" style="width: 20%">
                    <span class="sr-only">20% Complete (warning)</span>
                  </div>
                  <div class="progress-bar progress-bar-danger" style="width: 10%">
                    <span class="sr-only">10% Complete (danger)</span>
                  </div>
                </div>
                
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                  </div>
                  <div class="panel-body">
                    Panel content
                  </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>