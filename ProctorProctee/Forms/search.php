
<?php
include  "form.php";

$cid = $id = $name = $activity = "";

if(isset($_POST['searchId'])){
  $cid = $_POST['searchId'];
}

if(isset($_POST['submit_search'])){

          if(isset($_POST['searchId'])){
            $sql = "SELECT * FROM cocurricular where c_id = '$cid' ";
          }

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
      ?>
</body>
</html>