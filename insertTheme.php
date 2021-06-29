<?php
	/*$id = $_GET["id"];
	$library = $_GET["library"];
	$name = $_GET["name"];
	$color = $_GET["color"];
	$date = $_GET["date"];
	$tags = $_GET["tags"];*/
	$id = $_POST["id"];
	$library = $_POST["library"];
	$name = $_POST["name"];
	$color = $_POST["color"];
	$date = $_POST["date"];
	$tags = $_POST["tags"];

	if($id==null ||$library==null ||$name==null ||$color==null ||$date==null ||$tags==null){
		echo "_GET ERROR<br>";
		exit();
	}

	$host = 'localhost';//ip 주소<center></center>
	$user = 'wuddlaa';
	$password = 'roqkfwk!2';
	$dbName = 'wuddlaa';
	$conn = mysqli_connect($host, $user, $password, $dbName); //디비 연결및 선택

	if (!$conn) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	$sql = "INSERT INTO Pallet_Theme(id,library,name,color, date,tags) VALUES('$id','$library','$name','$color', '$date','$tags');";
	mysqli_query($conn,$sql);

	$sql = "SELECT * FROM Pallet_Theme WHERE id='$id' AND library='$library' AND name='$name' AND color='$color'AND date='$date'AND tags='$tags';";
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장
	$data = array();

	if(!$result)
		echo json_encode($data["flag"] = "false");
	else
		echo json_encode($data["flag"] = "true");

	
	mysqli_close($conn);

?>
