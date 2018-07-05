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
  
 <?php
   include "connect.php";
   session_start();
   $flag = "";
   $session_id = $_SESSION['id'];
   $activitynameErr = $commentnameErr = $sendErr = $sendflag = "";

							if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if(isset($_POST['send']))
							{
								    $sendflag=0;
									if (empty($_POST['send'])) {
										$sendErr = "Comment box is empty";
									}
									else{
										$send = test_input($_POST['send']);
										$sendflag=1;
									}
									if($sendflag==1){
										
										$sqlsend ="INSERT INTO studentcomment (Activityid,Name,cid,Comment) VALUES ('$activityidsend','$name','$session_id','$send')";
										if ($conn->query($sqlsend) === TRUE) {
											echo "New record created successfully";
										} else {
											echo "Error: " . $sql . "<br>" . $conn->error;
										}
									
									}
							}
							}
											
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if(isset($_POST['create'])){
		  
		  
		if (empty($_POST['inputactivity'])) {
				$activitynameErr = "Activity Name is required";
				
			}
		else{
				$activity = test_input($_POST['inputactivity']);
				
			}
  
		if (empty($_POST['inputcomment'])) {
				$commentnameErr = "Some comment is required";
				
			}
		else{
				$comment = test_input($_POST['inputcomment']);
				
			}
  
      
  
		if(!(empty($comment) || empty($activity)) ) {
				
				$flag = 1;
			}
  
	  }
   } 
	  function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
	  
if($flag==1){
	
   $sql1 = "SELECT name from proctor where id ='".$session_id."';";
   $result = $conn->query($sql1); 
    
    while($row = $result->fetch_assoc()) {
         $name=$row["name"];
		}
		
	
  $activityid= rand(1111111,9999999);;
  $stdcomment=$comment;
  $sql ="INSERT INTO announcement (Id,name,Activity,Activityid) VALUES ('$session_id','$name','$activity','$activityid')";
  $sql2 ="INSERT INTO studentcomment (Activityid,Name,cid,Comment) VALUES ('$activityid','$name','$session_id','$stdcomment')";
	$flag=0;	
    if ($conn->query($sql) === TRUE&&$conn->query($sql2) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	  $conn->close();
}
    ?>
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
            <li ><a href="../../index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <li ><a href="proctorselectproctee.php"><i class="fa fa-circle-o"></i>Manage Proctee</a></li>   
            <li class="active"><a href="announcementsproctor.php"><i class="fa fa-circle"></i>Announcements </a></li>
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
            <li class="active">Proctor</li>
          </ol>
        </section>
          <section class="content">

        <section class="content">
           <div class="row">
             <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Announcements</a></li>         
                  <li><a href="#settings" data-toggle="tab">Create Announcement</a></li>
                </ul>
                 <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    
					
<?php
   
   
   $sqlproctoractivity1 = "SELECT * from announcement where id ='".$session_id."';";
   $sqlproctoractivity2=$conn->query($sqlproctoractivity1);
  
	
	if($sqlproctoractivity2->num_rows >0)
	{
     while($row = $sqlproctoractivity2->fetch_assoc()) 
	 {
         
		$sqlcomment1 = "SELECT * from studentcomment where Activityid ='".$row["Activityid"]."';";
	    $sqlcomment2 = $conn->query($sqlcomment1);
		
		$timediff = "select TIMESTAMPDIFF(DAY,Time, NOW()) from announcement where Activityid ='".$row["Activityid"]."';";
		$r = $conn->query($timediff);
		$rowdiff = $r->fetch_assoc();
		
	?>
				<div style="border:1px solid black;padding:10px;cell-spacing:20px">
                    <!-- Post -->
                    <div class="post clearfix">
                      <div class='user-block'>
                        <img class='img-circle img-bordered-sm' src='../../dist/img/sandu.png' alt='user image'>
                        <span class='username'>
                          <a href="#"><?php echo $row["name"]; ?></a>
						  
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
						  </span>
                        <span class='description'><?php  echo implode(',',$rowdiff)." day ago" ?></span>
						  <h2><?php echo $row["Activity"]; ?><h2>
						  
                        
                      </div>

<?php	
		
		
		
		if($sqlcomment2->num_rows >0)
		{
			while($rowd = $sqlcomment2->fetch_assoc())
			{	
 ?>  
                      <p>
                        <?php
						echo $rowd["Name"]." : ".$rowd["Comment"];
						?>
                      </p>
                      <form class='form-horizontal'>
                        <div class='form-group margin-bottom-none'>
                          <div class='col-sm-9'>                   
                            <input class="form-control input-sm" placeholder="Comment">
                          </div>       					
                          <div class='col-sm-3'>			  
                            <button class='btn btn-danger pull-right btn-block btn-sm' type="submit" id="send" name="send"  >Send</button>
                							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                							<span class="error">*<?php echo $sendErr; ?></span>	
                          </div>                          
                        </div>                        
                      </form>				  
				          	</div>   
                 </div>         
<?php  
            }
        }
	 }
	}
	 $conn->close();
?>
                               
                  </div>
                
                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="POST">
					
                      <div class="form-group">
                        <label for="inputactivity" class="col-sm-2 control-label">Activity Name</label>
                        <div class="col-sm-10">
							<input type="text" class="form-control" name="inputactivity" id="inputactivity" placeholder="Subject of Activity">
							<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
							<span class="error">*<?php echo $activitynameErr; ?></span>
						</div>
                      </div>
					  
					  <div class="form-group">
                        <label for="inputcomment" class="col-sm-2 control-label">ADD Some Comment</label>
                        <div class="col-sm-10">
							<input type="text" class="form-control" name="inputcomment" id="inputcomment" placeholder="Add comment here...">
							<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
							<span class="error">*<?php echo $commentnameErr; ?></span>
						</div>

						</div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" id="create" name="create" >Create</button>
                        </div>
						
                      </div>
					  
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
	`
        </section><!-- /.content -->
		
		
							
		
      </div><!-- /.content-wrapper -->
    
      <div class="control-sidebar-bg"></div>
    </div>
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <script src="../../dist/js/app.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
  </body>
</html>
