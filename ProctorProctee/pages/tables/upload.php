<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
            $(document).ready(function(){
            $('#myDropDown').change(function(){
                var inputValue = $(this).val();
                window.location.href="upload.php?uid="+inputValue;
            });
        });
</script>
<body>

<form method="post" enctype="multipart/form-data"> 
	<select class="btn btn-success" name = "select_month" id="myDropDown">
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

	<input type="file" name="file">
	<input type="submit" name="upload-file" value="Upload File">
	<input type="submit" name="upload-data" value="Upload data">
</form>


<?php

include '../examples/connect.php';

if (isset($_GET['uid'])){

$m = $_GET['uid'];
$sql1 = "select path,file from uploads where file = '".$m."';";
$result = $conn->query($sql1);          

while ($row = $result->fetch_assoc()) {
	$path = $row['path'];
	$file = $row['file'];
	?>

	<a href="<?php echo $path; ?>">Attendance of <?php echo $file; ?></a>
	<?php

}
}
if(isset($_POST['select_month'])){
	$month = $_POST['select_month'];
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

	 include('../../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

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
</body>
</html>