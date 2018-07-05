<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>KJSCE SmartClass | SelectProctee</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
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
                  <!-- Menu Footer-->
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
              <p> <?php
                       if(!isset($_SESSION))
                          session_start();
                       echo "".$_SESSION['name'];  ?>                       
                       </p>
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
            <li class="active"><a href="../../index.php"><i class="fa fa-circle-o"></i> Dashboard </a></li>
            
           <?php
           if(!isset($_SESSION))
              session_start();
            if($_SESSION['type'] == "Proctor"){
            ?>
            <li class="active"><a href="proctorselectproctee.php"><i class="fa fa-circle-o"></i>Manage Proctee</a></li>   

            <li ><a href="announcementsproctor.php"><i class="fa fa-circle"></i>Announcements </a></li>
            <?php  }
            
             if($_SESSION['type'] == "Proctee"){
            ?>
            <li ><a href="announcementsproctee.php"><i class="fa fa-circle"></i>Announcements </a></li>
            <?php  }
            ?>
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
            Select Your Proctee 
          </h1>
          <ol class="breadcrumb">
		    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Proctor</a></li>
            <li class="active">Select Proctee</li>
          </ol>
        </section>
		<form method="POST" >
  <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Student List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
 		<div class="col-sm-10">
							<thead><th>NAME OF STUDENT</th><th>EMAIL OF STUDENT</th><th>SELECT AS PROCTEE</th></thead>
		</div>	
		<?php 
		include "connect.php";
    if(!isset($_SESSION))
      session_start();
   $session_id = $_SESSION['id'];

    $sqlproc = "SELECT * from proctee where  ISNULL(proctorid)";
	$resultstd = $conn->query($sqlproc);
	while($row = $resultstd->fetch_assoc())
	{
		
		
		?>
		
			            <div class="col-sm-10">
							<tr align="center"><td><?php echo $row["name"] ?></td><td><?php echo $row["email"] ?></td><td><input type="checkbox" name="check_list[]" value="<?php echo $row["id"] ?>"/></td></tr>
							<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
						</div>	
						
						
	
<?php 

    }

?>	
    </table>
	<button class='btn btn-danger pull-right btn-block btn-sm' type="submit" id="submit" name="submit">ADD PROCTEE</button>
	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	</form>
	
<?php 
if(isset($_POST["submit"])){
	
if(!empty($_POST["check_list"])) {
    foreach($_POST["check_list"] as $check) {
     $sql ="Update proctee set proctorid='$session_id' where id='$check';";
		if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
		}
}

}
$conn->close();
?>	
	
        </section>
      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">K. J. Somaiya College of Engineering</a>.</strong> All rights reserved.
      </footer>

    
      <div class="control-sidebar-bg"></div>
    </div>
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <script src="../../dist/js/app.min.js"></script>
     <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>  
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    <script src="../../dist/js/demo.js"></script>
  </body>
</html>
