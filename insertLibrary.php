<?php
	$id = $_POST["id"];
	$library = $_POST["library"];
	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null ||$library==null){
		echo "_GET ERROR<br>";
		exit();
	}

	$host = 'localhost';//ip 주소
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
	$data = array();

	$sql = "SELECT * FROM Pallet_Library WHERE id='$id' AND library='$library';";
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장

	$count = mysqli_num_rows($result);

		if($count > 0){ //id Overlap check
			//echo "ID Overlap, Query rows num : $count<br>";
			echo json_encode($data["overlap"] = "overlap");
		}

	$sql = "INSERT INTO Pallet_Library VALUES('$id','$library');";
	mysqli_query($conn,$sql);

	$sql = "SELECT * FROM Pallet_Library WHERE id='$id' AND library='$library';";
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장
	

	if(!$result)
		echo mysqli_error($result)."<br>";
	
	$count = mysqli_num_rows($result);

	if($count == 1)
		echo json_encode($data["overlap"] = "true");
	else{
		echo "Pallet_Library Insert Fail, Query rows num : $count<br>";
		mysqli_close($conn);
		exit();
	}
	
	mysqli_close($conn);

?>
