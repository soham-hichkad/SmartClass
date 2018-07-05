<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KJSCESmartClass</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
       <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
	
   <style>
      .error {color: #FF0000;}

body, html {
    height: 100%;
    margin: 0;
}

.bg {
    /* The image used */
    background-image: url("background.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	position: relative;
}
    </style>
  </head>
   <?php
    $err = "";
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "kjsce";

   
   $conn = new mysqli($servername, $username, $password, $dbname);
   $email = $psw = $flag = "";
   $name = "";
   $type = "";
   $id = "";
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
   }
      if(isset($_POST['submit'])){
        $email = $_POST["email"];
        $psw = $_POST["psw"];

        $sql = "SELECT * from proctor where email ='".$email."' AND password = '".$psw."';";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
           while($row = $result->fetch_assoc()) {
          $flag = 1;
          $type = "Proctor";
          $name =  $row['name'];
          $id = $row['id'];
        }
      }
        else{
          $flag = 2;
          $sql = "SELECT * from proctee where email ='".$email."' AND password = '".$psw."';";
          $result = $conn->query($sql);
        }
        if ($result->num_rows == 1) {
           while($row = $result->fetch_assoc()) {
          $flag = 1;
          $type = "Proctee";
          $name =  $row['name'];
          $id = $row['id'];
        }
      }
          if($flag == 1){
            session_start();
            $_SESSION['type'] = $type; 
            $_SESSION['name'] = $name;
            $_SESSION['id'] = $id;
            header("Location:../../index.php");
          }
      
      else{
       $err = "Email and Password not matching";
      }
    }
  
    
    ?>
	
	<div class="bg">
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
       <b>KJSCE</b>SmartClass</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="psw" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="error"><?php echo $err; ?></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
             
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="register.php" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</div>
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
  </div>
</html>
