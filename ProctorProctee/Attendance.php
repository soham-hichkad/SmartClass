
<?php 
  session_start();
if(isset($_POST['view'])){
  header("location: data.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KJSCE SmartClass | Attendance</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
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
            <li ><a href="index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            
           <?php
           if(!isset($_SESSION))
              session_start();
            if($_SESSION['type'] == "Proctor"){
            ?>
            <li ><a href="pages/examples/proctorselectproctee.php"><i class="fa fa-circle-o"></i>Manage Proctee</a></li>   
            <li ><a href="pages/examples/announcementsproctor.php"><i class="fa fa-circle"></i>Announcements </a></li>
            <?php  }
            
             if($_SESSION['type'] == "Proctee"){
            ?>
            <li ><a href="pages/examples/announcementsproctee.php"><i class="fa fa-circle"></i>Announcements </a></li>
            <?php  }
            ?>
            <li class="active"><a href="Attendance.php"><i class="fa fa-book"></i>Attendance</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>
        </section>
      </aside>
  

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Attendance
            <small>SmartClass</small>
          </h1>
        </section>
         <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-primary"><br><br>
                 <form method="post" enctype="multipart/form-data"> 
                   &nbsp; Select a Month: &nbsp; <select class="btn btn-success" name = "select_month" id="myDropDown" class="col-md-2">
                      <option value="No" disabled="disabled">Select a month</option>
                      <option value="January">January</option>
                      <option value="February">February</option>
                      <option value="March"> March</option>
                      <option value="April">April </option>
                      <option value="May"> May</option>
                      <option value="June">June </option>
                      <option value="July">July </option>
                      <option value="August"> August</option>
                      <option value="September">September </option>
                      <option value="October"> October</option>
                      <option value="November"> November</option>
                      <option value="December">December </option>
                  </select>
                <br><br>

                

                  <?php
                    if($_SESSION['type'] == "Proctor"){
                  ?>

                  <div class="btn-group">
                   &nbsp;&nbsp; <input type="file" id="file" name="file" class="btn ">
                  </div>
                  <br><br><br>

                    <div class=" box-primary" >
                     &nbsp;&nbsp; <input type="submit" id="submit" name="upload-file" value="Upload File" class="btn  btn-info" data-toggle="tooltip" title="CLick To Upload File!">
                      
                    </div>    <br><br>

                     <div class=" box-primary">
                     &nbsp;&nbsp; <input type="submit"  name="upload-data" value="Upload Data" class="btn btn-info" data-toggle="tooltip" title="Click To Upload Data of uploaded file!">
                    </div> <br><br>

                     <div class=" box-primary">
                     &nbsp;&nbsp; <input type="submit" name="download" value=" download" class="btn btn-warning" data-toggle="tooltip" title="Click To download Existing File!">
                    </div> <br><br>

                     <div class=" box-secondary">
                     &nbsp;&nbsp; <input type="submit" name="delete" value=" Delete" class="btn btn-danger" data-toggle="tooltip" title="Click To Delete Existing File!">
                    </div> <br><br>
<?php
                    }
?>                    <div class=" box-primary">
                      &nbsp;&nbsp;<input type="submit" name="view" value="See Data" class="btn btn-success" data-toggle="tooltip" title="Click To Display the Attendance!">
                      </div>
                       <br><br>
              </div>

             </form>

                </div>            
              </div>
            </div>
           </div>
          </section>
      

<?php
include "pages/examples/connect.php";    
$month="";
if(isset($_POST['select_month'])){
  $month =  $_POST['select_month'];
  $_SESSION['month_s'] = $_POST['select_month'];
}

if(isset($_POST['download'])){
  $sql = "select * from uploads where file = '".$month."';";
  $result = $conn->query($sql);   

  while($row = $result->fetch_assoc()) {
      $path =  $row['path'];
      $file =  $row['file'];
        echo '<a href="'.$path.'">Attendance for '.$month.'</a>';
  }       
}

if(isset($_POST['delete'])){
  $sql = "select * from uploads where file = '".$month."';";
  $result = $conn->query($sql); 

   while($row = $result->fetch_assoc()) {
      $path =  $row['path'];
      $file =  $row['file'];
      $del = unlink($path);

      if($del){
        $sql = "delete from uploads where file = '".$month."';";
        $result = $conn->query($sql); 


        if ($conn->query($sql) === TRUE) {
           echo "Record deleted successfully";
        } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
        } 
      }
  }       



}

if(isset($_POST['upload-file'])){
  if(isset($_FILES['file'])){
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $type = $_FILES['file']['type'];
    $tmp = $_FILES['file']['tmp_name'];
    $file = 'uploads/'.$_FILES['file']['name'];

    $move = move_uploaded_file($tmp,$file);

    $sql = "INSERT INTO uploads (file,path) VALUES ('$month','$file')";

    if ($conn->query($sql) === TRUE) {
        echo "record added successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
}


if(isset($_POST['upload-data'])){
   $path = "";

   include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

   $sql = "select path from uploads where file = '".$month."';";
   $result = $conn->query($sql);

  if ($result->num_rows == 1) {
       
    $row = $result->fetch_assoc();
    $inputFileName = $row['path'];
    
    try {
      $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel = $objReader->load($inputFileName);
  } catch(Exception $e) {
      die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
  }

  $objWorksheet = $objPHPExcel->getSheet(0); 
  $highestRow = $objWorksheet->getHighestRow(); 
  $highestColumn = $objWorksheet->getHighestColumn();

   $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
    $headingsArray = $headingsArray[1];
    $r = -1;
    $namedDataArray = array();
    for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
         ++$r;
    foreach($headingsArray as $columnKey => $columnHeading){
        $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
      }
    }
  }

  $dbMapping = array(
      'col1' => 'student',
      'col2' => 'email',
      'col3' => 'Attendance'
  );

  foreach($namedDataArray as $key=>$value){
    $student = $value[$dbMapping['col1']];
    $email = $value[$dbMapping['col2']];
    $attendance = $value[$dbMapping['col3']];
    
    $sql = "INSERT INTO proctee_month(attendance,email,month) values('$attendance','$email','$month');";

     if ($conn->query($sql) === TRUE) {
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
  $conn->close();
}
}
?>
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="dist/js/app.min.js"></script>
  </body>
</html>