<!DOCTYPE html>
<html>
  <head>
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KJSCESmartClass</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  </head>
<div class="bg">
  <body class="hold-transition register-page">

  <?php

  	include "connect.php";

    $fname = $id = $email = $contact = $psw = $repsw = "";
    $fnameErr = $idErr = $emailErr = $contactErr = $pswErr = $repswErr = $matchErr = "";
    $flag = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST['register'])){

  if (empty($_POST['fname'])) {
    $fnameErr = "Name is required";
  }
  else{
    $fname = test_input($_POST['fname']);
  }
    
  if (empty($_POST['id'])) {
    $idErr = "Id is required";
  }
  else if(strlen($_POST['id'])!=5 || strlen($_POST['id'])!=10) {
	$idErr = "Id is invalid";  
  }
  else{
    $id = test_input($_POST['id']);
  }

  if (empty($_POST['email'])) {
    $emailErr = "Email is required";
  }
  else if (!preg_match("/(\W|^)*@somaiya\.edu(\W|$)/",$_POST['email'])){
   $emailErr = "Email is retricted to somaiya.edu";
  }
  else{
    $email = test_input($_POST['email']);
  }
  if (empty($_POST['psw'])) {
    $pswErr = "Password is required";
  }
  else{
    $psw = test_input($_POST['psw']);
  }
  if (empty($_POST['repsw'])) {
    $repswErr = "Retype password again";
  }
  elseif (strcmp($_POST['psw'],$_POST['repsw']) != 0) {
  	$repswErr = "Password not mathcing";
  }
  else{
    $repsw = test_input($_POST['repsw']);
  }
  if (empty($_POST['contact'])) {
    $contactErr = "Contact is required";
  } 
  else{
    $contact = test_input($_POST['contact']);
  }
  if(!(empty($fname) || empty($id) || empty($psw) || empty($repsw) || empty($contact) || empty($email))) {
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

  if($flag == 1){
  	$num_length = strlen((string)$id);

  		if($num_length == 5){
    	$sql = "INSERT INTO proctor (name,id,password,email,contact)
    	VALUES ('$fname','$id','$psw','$email','$contact')";
  		}
  		elseif ($num_length == 10) {
  		$sql = "INSERT INTO proctee (name,id,password,email,contact)
    	VALUES ('$fname','$id','$psw','$email','$contact')";
  		}
    	
  	

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
       header("Location:login.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	$conn->close();
	}

  ?>

   <div class="register-box">
      <div class="register-logo">
        <b>KJSCE</b>SmartClass</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="fname" placeholder="Full name" value = "<?php echo $fname;?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="error">*<?php echo $fnameErr; ?></span>
          </div>
           <div class="form-group has-feedback">
            <input type="number" class="form-control" name="id" placeholder="S.V.V ID" value = "<?php echo $id;?>">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <span class="error">*<?php echo $idErr; ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email" value = "<?php echo $email;?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="error">*<?php echo $emailErr; ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="psw" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="error">*<?php echo $pswErr; ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="repsw" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <span class="error">*<?php echo $repswErr; ?></span>
          </div>
           <div class="form-group has-feedback">
            <input type="number" class="form-control" name="contact" placeholder="Contact number" value = "<?php echo $contact;?>">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <span class="error">*<?php echo $contactErr; ?></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
                <button type="submit" name="register" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

      

        <a href="login.php" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

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
