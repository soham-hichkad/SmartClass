<?php
        session_start(); 
    
include "page.html";
include "connect.php";
?>

                  <?php
              
                    if(isset($_POST['view_all'])){
                      $sql = "SELECT * FROM cocurricular";
                      $result = $conn->query($sql);                   
                  ?>
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                           <h3 class="box-title">Co-curricular Data</h3>
                        </div><!-- /.box-header -->
                      <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                  <?php
                    echo "<tr><th>CID</th><th>FID</th><th>SID</th><th>F_name</th><th>S_name</th><th>Activity</th><th>Dur_From</th><th>Dur_To</th><th>org</th></tr>";
                    while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['c_id']."</td>";
                    echo "<td>".$row['f_id']."</td>";
                    echo "<td>".$row['s_id']."</td>";
                    echo "<td>".$row['f_name']."</td>";
                    echo "<td>".$row['s_name']."</td>";
                    echo "<td>".$row['activity_name']."</td>";
                    echo "<td>".$row['dur_from']."</td>";
                    echo "<td>".$row['dur_to']."</td>";
                    echo "<td>".$row['org_commitee']."</td>"; 
                    }
                    ?>
                    </table>
                    </div>
                    </div>
                    </div>
                    </div>
                    <?php
                  }

                  if(isset($_POST['view_your'])){
                      $sql = "SELECT * FROM cocurricular";
                      $result = $conn->query($sql);                                      
                  ?>

                  <div class="row">
                    <div class="col-xs-12">
                      <div class="box">
                        <div class="box-header">
                           <h3 class="box-title">Co-curricular Data</h3>
                        </div><!-- /.box-header -->
                      </div>
                      <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <?php
                    echo "<tr><th>CID</th><th>FID</th><th>SID</th><th>F_name</th><th>S_name</th><th>Activity</th><th>Dur_From</th><th>Dur_To</th><th>org</th><th>Update</th><th>Delete</th></tr>"; ?>
                    </thead>
                    <?php
                    while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['c_id']."</td>";
                    echo "<td>".$row['f_id']."</td>";
                    echo "<td>".$row['s_id']."</td>";
                    echo "<td>".$row['f_name']."</td>";
                    echo "<td>".$row['s_name']."</td>";
                    echo "<td>".$row['activity_name']."</td>";
                    echo "<td>".$row['dur_from']."</td>";
                    echo "<td>".$row['dur_to']."</td>";
                    echo "<td>".$row['org_commitee']."</td>";
                    echo "<td><form action='edit.php' method='POST'><input type='hidden' name='tempId' value='".$row["c_id"]."'/><input type='submit' name='update' class='btn btn-primary' value='Update' /></form>"; 
                    echo "<td><form action='delete.php' method='POST'><input type='hidden' name='delId' value='".$row["c_id"]."'/><input type='submit' name='delete' class='btn btn-primary' value='Delete' /></form>";  ?>&nbsp <?php
                   
                    }
                      
                  }


if(isset($_POST['add'])) {
  $nameErr = $orgErr = $fromErr = $toErr = $actErr = $test_date = $test_arr =""; 
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

  cid : <input type = "number" class="form-control"  name = "cid"><br><br>


  fid : <?php
          $query = "SELECT F_ID FROM facultyinfo;";
          $result = mysqli_query ($conn,$query);
          echo "<input list='f_id' name = 'f_id' id = 'fid' class='form-control'>";
          echo "<datalist id= 'f_id'>";
          while($r = mysqli_fetch_array($result)) {
           echo "<option value = '".$r['F_ID']."'</option>";
          }
          echo "</datalist>";
          ?><br><br>

  sid : <?php
          $query = "SELECT staff_id FROM staffinfo;";
          $result = mysqli_query ($conn,$query);
          echo "<input list='s_id' name = 's_id' id = 'sid' class='form-control' disabled>";
          echo "<datalist id= 's_id' >";
          while($r = mysqli_fetch_array($result)) {
           echo "<option value = '".$r['staff_id']."'</option>";
          }
          echo "</datalist>";
          ?><br><br>

  Faculty Name : <input type = "text" class="form-control" name = "faculty" id="f">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  Staff Name : <input type = "text" class="form-control" name = "staff"  id="s" disabled>
  <span class="error">*<?php echo $nameErr;?></span>
  <br><br>

  Activity Name :  <input type = "text" class="form-control" name = "activity">
  <span class="error">*<?php echo $actErr;?></span>
  <br><br>

  Duration from : <input type = "date" name = "from"> to <input type = "date"  name = "to">
  <span class="error">* <?php echo $fromErr; echo" , "?> <?php echo $toErr;?></span> 
  <br><br>

  Organized by : <input type = "text" class="form-control" name = "organizer">
  <span class="error">*<?php echo $orgErr;?></span><br><br>

  Purpose & Activity :<br><br> <textarea rows = "10" cols = "50" class="form-control" name = "Purpose"></textarea><br><br>

  How many Files to be attached : <select name= "num" onchange="fileCount(this.options[this.selectedIndex].value)">
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

    <input type="file" name="upload"><br><br>

  <input type="submit" name="sub" class="btn btn-primary value="Submit">  
  </fieldset>
  </form>
 <?php
}

if(isset($_POST['search'])) {
  $_SESSION['lid'] = "";
?>
<section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
        <form method="post" action="search.php">  
          <fieldset>
          <legend>Search By</legend>

  cid : <input type = "number" class="form-control"  name = "searchId">

  <br><br>
  <input type = "submit" class="btn btn-primary" name = "submit_search"  >
    </fieldset>
    </form>
    </div>
    </div>
    </div>
    </div>
    </section>


    <?php

    if(isset($_POST['submit_search'])){
      $_SESSION['lid'] = $_POST['searchId'];
    }

    }

 ?>

</body>
</html>