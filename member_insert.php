<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];


              
    $con = mysqli_connect("localhost", "root", "", "sample");

	$sql = "insert into members(id, pass, level, point) ";
	$sql .= "values('$id', '$pass', 9, 0)";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
