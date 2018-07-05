<?php 
if(!isset($_SESSION)){
  session_start();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KJSCE SmartClass</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<style>
.mySlides {display:none;}
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.9);
    transition: 0.2s;
   
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
    padding: 2px 16px;
}
</style>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="index.html" class="logo">
          <span class="logo-mini">K<b></b>J</span>
          <span class="logo-lg"><b>KJSCESmartClass</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/sandu.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"> <?php
                       if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="dist/img/sandu.png" class="img-circle" alt="User Image">
                    <p>
                      <?php
                       if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['name']; ?>
                      <small><?php if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['type']; ?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                    <form action="pages/examples/login.php">
                      <button class="btn btn-default btn-flat">Sign out</button>
                    </form>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/sandu.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php
                       if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['name'];  ?>    </p>
            <i class="fa fa-circle text-success"></i>  <?php echo "".$_SESSION['type']; ?>
            </div>
          </div>
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
           <ul class="sidebar-menu">
            <li class="active"><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard </a></li>
                      
           <?php
           if(!isset($_SESSION))
              session_start();
            if($_SESSION['type'] == "Proctor"){
            ?>
           
            <li ><a href="pages/examples/announcementsproctor.php"><i class="fa fa-circle-o"></i>Announcements </a></li>
            <?php  }
            
             if($_SESSION['type'] == "Proctee"){
            ?>
            <li ><a href="pages/examples/announcementsproctee.php"><i class="fa fa-circle"></i>Announcements </a></li>
            <?php  }
            ?>
            <li ><a href="Attendance.php"><i class="fa fa-book"></i>Attendance</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
      </aside>

	  <div class="content-wrapper">
        <section class="content-header">
			
<div class="card">
<h2 class="w3-center" style="font-weight: bold;"><center>K. J. SOMAIYA COLLEGE OF ENGINEERING</center></h2>
				<div class="w3-content w3-section" style="max-width:1000px">
				<img class="mySlides" src="img1.jpg" style="width:100%">
				<img class="mySlides" src="img2.jpg" style="width:100%">
				<img class="mySlides" src="img3.jpg" style="width:100%">
			</div>
			<div class="container">
			
			</div>
</div>			
		</section>
	  </div>
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="dist/js/app.min.js"></script>
  </body>
</html>

