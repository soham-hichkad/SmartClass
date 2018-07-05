<?php
include "Form.php";
include "connect.php";
?>

  <?php
$conn = $_SESSION['conn'];

if(isset($_POST['delId'])){
  $_SESSION['cur_id'] = $_POST['delId'];
}

 $l_id = $_SESSION['cur_id'];

if(isset($_POST['delete'])){

        $sql = "delete FROM cocurricular where c_id = '$l_id'; ";
       if ($conn->query($sql) === TRUE) {
          echo "Record deleted successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
}
  ?>