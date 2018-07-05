<?php
include "connect.php";
include "form.php";
?>

<?php
// define variables and set to empty values
$fname = $sname = $name = $organizer = $date_from = $date_to = $activity  = $date= $id = "";
 $nameErr = $orgErr = $fromErr = $toErr = $actErr = $test_date = $test_arr = $cidErr = $idErr = ""; 
 $var = 1;
$date_now = new DateTime();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if((empty($_POST["cid"]))){
    $cidErr = "Enter Co-curricular id";
    $var = 0;
  }
  else{
    $cid = $_POST["cid"];
  }
  if((empty($_POST["fid"])) && (empty($_POST["cid"]))){
    $idErr = "Enter Faculty/staff id";
    $var = 0;
  }

  if((empty($_POST["faculty"])) && empty($_POST["staff"])) {
    $var = 0;
    $nameErr = "Name is required";
  } 
  else{
    if((empty($_POST["faculty"]))){
      $sname = test_input($_POST["staff"]);
      $name = $sname;
    }
    else{
      $fname = test_input($_POST["faculty"]);
      $name = $fname;
    }

    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
      $name = "";
      $var = 0;
    }
  }

  if (empty($_POST["from"])) {
    $var = 0;
    $fromErr = "From date is required";
  }
  else{
    $date_f = new DateTime($_POST["from"]);
    if ($date_now > $date_f) {
        $fromErr = "From date should be valid future date";
        $var = 0;
    }else{
      $date_from = test_input($_POST['from']);
      $fromErr = "";
  }
  }
  if (empty($_POST["to"])) {
     $var = 0;
    $toErr = "To date is required";
  }
  else{
    $date_to = test_input($_POST['to']);
    if ($date_from > $date_to) {
        $toErr = "to date should be ahead of from date";
        $var = 0;
    }else{
      $date_to = test_input($_POST['to']);
  }
  }

  if (empty($_POST["activity"])) {
     $var = 0;
    $actErr = "Activity is required";
  }
  else{
    $activity = test_input($_POST["activity"]);
  }

  if (empty($_POST["organizer"])) {
     $var = 0;
    $orgErr = "organizer is required";
  } 
  else{
    $organizer = test_input($_POST["organizer"]);
  }

  if(isset($_POST['fid'])){
    $id = $_POST['fid'];
  }
  if(isset($_POST['sid'])){
    $id = $_POST['sid']; 
  }



}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST['sub'])){

?>
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
<form method="post" action="add.php">  
<fieldset>
<legend>Co-curricular activity </legend>
<p><span class="error">* required field.</span></p><br>
  Faculty/Staff :
   <select name="choice" id = "choice" onchange="fn1(this.options[this.selectedIndex].value)">
      <option value = "faculty">Faculty</option>
      <option value = "staff">Staff</option>
  </select>
  <br><br>

 cid :   <input type = "number" class="form-control" name = "cid" id="c_id" value="<?php echo $cid;?>"><br><br>
         <span class="error">* <?php echo $cidErr;?></span>
         <br><br>

 fid : <?php
         
          $query = "SELECT F_ID FROM facultyinfo;";
          $result = mysqli_query ($conn,$query);
          echo "<input list='f_id' name = 'fid' id = 'fid' class='form-control'>";
          echo "<datalist id= 'f_id'>";
          while($r = mysqli_fetch_array($result)) {
           echo "<option value = '".$r['F_ID']."'</option>";
          }
          echo "</datalist>";
          ?><br><br>

  sid : <?php
          $query = "SELECT staff_id FROM staffinfo;";
          $result = mysqli_query ($conn,$query);
          echo "<input list='s_id' name = 'sid' id ='sid' class='form-control'  disabled>";
          echo "<datalist id= 's_id' >";
          while($r = mysqli_fetch_array($result)) {
           echo "<option value = '".$r['staff_id']."'</option>";
          }
          echo "</datalist>";
          ?><br><br>
          <span class="error">* <?php echo $idErr;?></span>
         <br><br>


  Faculty Name : <input type = "text" class="form-control" name = "faculty" id="f"  value="<?php echo $fname;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  Staff Name : <input type = "text" class="form-control" name = "staff"  id="s" value="<?php echo $sname;?>" disabled>
  <span class="error">*<?php echo $nameErr;?></span>
  <br><br>

  Activity Name :  <input type = "text" class="form-control" name = "activity" value="<?php echo $activity;?>">
  <span class="error">*<?php echo $actErr;?></span>
  <br><br>

  Duration from : <input type = "date" name = "from" value="<?php echo $date_from;?>"> to <input type = "date"  name = "to" value="<?php echo 
  $date_to;?>">
  <span class="error">* <?php echo $fromErr; echo" , "?> <?php echo $toErr;?></span> 
  <br><br>

  Organized by : <input type = "text" class="form-control" name = "organizer" value="<?php echo $organizer;?>">
  <span class="error">*<?php echo $orgErr;?></span><br><br>

  Purpose & Activity :<br><br> <textarea rows = "10" cols = "50" class="form-control" name = "Purpose"></textarea><br><br>

  How many Files to be attached : <select name= "num">
            <option value = "1">1</option>
            <option value = "2">2</option>
            <option value = "3">3</option>
            <option value = "4">4</option>
            <option value = "5">5</option>
            <option value = "6">6</option>
            <option value = "7">7</option>
            <option value = "8">8</option>
            <option value = "9">9</option>
            <option value = "10">10</option>
          </select>
          <br><br>

  <input type="submit"  class="btn btn-primary" name="sub" value="Submit">  
  </fieldset>
  </form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['sub']) && $var == 1){
$fid = $sid = "";
  $ch = $_POST['choice'];
  
  if($ch == 'staff'){
     $sid = $_REQUEST['s_id'];
     $s_name = $_REQUEST['staff'];
  }
  else{
    $fid = $_REQUEST['f_id'];
    $f_name = $_REQUEST['faculty'];
  }

  $cid = $_REQUEST['cid'];
  $activity_name = $_REQUEST['activity'];
  $dur_from = $_REQUEST['from'];
  $dur_to = $_REQUEST['to'];
  $org_commitee = $_REQUEST['organizer'];

  $ch = $_POST['choice'];


if(!empty($ch)){
  if($ch == 'staff'){

    $sql = "INSERT INTO cocurricular (c_id,f_id, s_id,f_name,s_name,activity_name,dur_from,dur_to,org_commitee)
    VALUES ('$cid',null,'$sid','','$s_name','$activity_name','$dur_from','$dur_to','$org_commitee')";
  }

  else{
    $sql = "INSERT INTO cocurricular (c_id,f_id, s_id,f_name,s_name,activity_name,dur_from,dur_to,org_commitee)
    VALUES ('$cid','$fid',null,'$f_name','','$activity_name','$dur_from','$dur_to','$org_commitee')";
  }


    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
}
$conn->close();
  
}
}
}
?>


</body>
</html>