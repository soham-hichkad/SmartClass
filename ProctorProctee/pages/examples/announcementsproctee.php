<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KJSCE SmartClass | Announcement</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  </head>
 
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="../../index.html" class="logo">
          <span class="logo-mini"><b>K</b>J</span>
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
                  <img src="../../dist/img/sandu.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"> <?php
                       if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['name']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../dist/img/sandu.png" class="img-circle" alt="User Image">
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
                       <form action="login.php">
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
              <img src="../../dist/img/sandu.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php
                       if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['name'];  ?>   </p>
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
            <li ><a href="../../index.php"><i class="fa fa-circle-o"></i> Dashboard </a></li>
            <li class="active"><a href="announcementsproctee.php"><i class="fa fa-circle"></i>Announcements </a></li>
            <li ><a href="../../Attendance.php"><i class="fa fa-book"></i>Attendance</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Announcements
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Announcement</a></li>
            <li class="active">Proctee</li>
          </ol>
        </section>

        <section class="content">
    
           
                    
<?php
  include "connect.php";
  if(!isset($_SESSION))
    session_start();
  $session_id = $_SESSION['id'];
  $sqlproc = "SELECT * from proctee where id ='".$session_id."';";
	$resultstd = $conn->query($sqlproc);
	$row = $resultstd->fetch_assoc();	
	
	$sqlannounce = "SELECT * from studentcomment where cid ='".$session_id."' OR cid='".$row["proctorid"]."';";
	$sqlprocname = "SELECT name from proctor where id ='".$row["proctorid"]."';";
	
	
	$resultannounce = $conn->query($sqlannounce);
	$resultprocans = $conn->query($sqlprocname);
	
	$rowd = $resultprocans->fetch_assoc();
	
	
     while($rowannounce = $resultannounce->fetch_assoc()) 
	 {
         
		$sqlannouncement="SELECT * from announcement where Activityid ='".$rowannounce["Activityid"]."';";
		$result = $conn->query($sqlannouncement);
		$rowann = $result->fetch_assoc();
		$timediff = "select TIMESTAMPDIFF(DAY,Time, NOW()) from announcement where Activityid ='".$rowannounce["Activityid"]."';";
		$r = $conn->query($timediff);
		$rowdiff = $r->fetch_assoc();
 ?>  

 
                   
                   <section class="content">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-primary"><br><br>
                             	<div style="border:1px solid black;padding:10px;cell-spacing:20px">

                              <div class="post clearfix">
                                <div class='user-block'>
                                  <img class='img-circle img-bordered-sm' src='../../dist/img/sandu.png' alt='user image'>
                                  <span class='username'>
                                    <a href="#"><?php echo $rowd["name"]; ?></a>
                                    <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                                  </span>
                                  <span class='description'><?php  echo implode(',',$rowdiff)." day ago" ?></span>
                                </div>
                                <p>
					  
                    						<h3><?php echo $rowann["Activity"]?></h3>
                    						<?php
                    						echo $rowannounce["Comment"];
                    						?>
                                </p>

                                  <form class='form-horizontal'>
                                    <div class='form-group margin-bottom-none'>
                                      <div class='col-sm-9'>
                                        <input class="input-sm" type="file" name="upload">
            							               <br>
                                        <input class="form-control input-sm" placeholder="Comment">
                                      </div>       
            								             <br>
                                      <div class='col-sm-3'>
                                        <button class='btn btn-danger  btn-block btn-sm'>Upload</button>
                                        <button class='btn btn-danger pull-right btn-block btn-sm'>Send</button>
                                      </div>                          
                                    </div>                        
                                  </form>				  
					                    </div> 				  
                          </div>
                         </div>
                       </div>
                     </div>
                    </section>                   
<?php 
   }
   $conn->close();
?>              
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
  </body>
</html>
