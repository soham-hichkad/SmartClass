<?php
include "Form.php";
include "connect.php";
?>

  <?php
  $date_now = new DateTime();

$conn = $_SESSION['conn'];

if(isset($_POST['tempId'])){
  $_SESSION['cur_id'] = $_POST['tempId'];
}

 $l_id = $_SESSION['cur_id'];

$name = $organizer = $date_from = $date_to = $activity  = $date = $id = "";
 $nameErr = $orgErr = $fromErr = $toErr = $actErr = $test_date = $test_arr = $flag = ""; 

$sql = "SELECT * FROM cocurricular where c_id = '$l_id'; ";
  $result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  if(empty($row['s_id'])){
    $name = $row['f_name'];
    $id = $row['f_id'];
    $flag = 1;
  }
  else{
    $name = $row['s_name'];
    $id = $row['s_id'];
    $flag = 2;
  }
   $organizer = $row['org_commitee']; 
   $date_from = $row['dur_from']; 
   $date_to = $row['dur_to']; 
   $activity = $row['activity_name'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if((empty($_POST["faculty"])) && empty($_POST["faculty"])) {
    $nameErr = "Name is required";
  } 
  else{
    if((empty($_POST["faculty"])))
      $name = test_input($_POST["staff"]);
    else 
      $name = test_input($_POST["faculty"]);

    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
      $name = "";
    }
  }

  if (empty($_POST["from"])) {
    $fromErr = "From date is required";
  }
 else{
    $date_f = new DateTime($_POST["from"]);
    if ($date_now > $date_f) {
        $fromErr = "From date should be valid future date";
        $var = 0;
    }else{
      $var = 1;
      $date_from = test_input($_POST['from']);
  }
  }
    
  if (empty($_POST["to"])) {
    $toErr = "To date is required";
  }
 else{
    if ($date_from > $date_to) {
        $toErr = "to date should be ahead of from date";
        $var = 0;
    }else{
      $var = 1;
      $date_to = test_input($_POST['to']);
  }
  }


  if (empty($_POST["activity"])) {
    $actErr = "Activity is required";
  }
  else{
    $activity = test_input($_POST["activity"]);
  }

  if (empty($_POST["organizer"])) {
    $orgErr = "organizer is required";
  } 
  else{
    $organizer = test_input($_POST["organizer"]);
  }

}

function getData(){

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['update'])){

?>
 <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<fieldset>

cid : <input type = "number" class="form-control" name = "cid" value="<?php echo $l_id;?>" disabled><br><br>

id : <input type = "number" class="form-control" name = "fid" id="f_id" value="<?php echo $id;?>" disabled><br><br>


   Name : <input type = "text" class="form-control" name = "faculty" value="<?php echo $name;?>" id="f">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  Activity Name :  <input type = "text" class="form-control" name = "activity" value="<?php echo $activity;?>">
  <span class="error">*<?php echo $actErr;?></span>
  <br><br>

  Duration from : <input type = "date"  name = "from" value="<?php echo $date_from;?>"> to <input type = "date"  name = "to" value="<?php echo 
  $date_to;?>">
  <span class="error">* <?php echo $fromErr; echo" , "?> <?php echo $toErr;?></span> 
  <br><br>

  Organized by : <input type = "text" class="form-control" name = "organizer" value="<?php echo $organizer;?>">
  <span class="error">*<?php echo $orgErr;?></span><br><br>

  Purpose & Activity :<br><br> <textarea rows = "10" cols = "50" name = "Purpose"></textarea><br><br>

  <input type="submit"  value="Update" name="update-val" class="btn btn-primary" >  

</fieldset>
</form>

<?php
}  
  if(isset($_POST['update-val'])){

if($flag == 1){
  $sql = "update cocurricular set f_name = '$name' , activity_name = '$activity' , dur_from = '$date_from' , dur_to = '$date_to' , org_commitee =  '$organizer' where c_id = '$l_id' ";
}
else if($flag == 2){
  $sql ="update cocurricular set s_name = '$name' , activity_name = '$activity' , dur_from = '$date_from' , dur_to = '$date_to' , org_commitee =  '$organizer' where c_id = '$l_id' ";
}


if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

}


?>


</body>
</html>