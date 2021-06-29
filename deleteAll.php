<?php

	$id = $_POST["id"];
	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null){
		echo "_GET ERROR<br>";
		exit();
	}
	
	$host = 'localhost';//ip 주소
	$user = 'wuddlaa';
	$pw = 'roqkfwk!2';
	$dbName = 'wuddlaa';
	$conn = mysqli_connect($host, $user, $pw, $dbName); //디비 연결및 선택

	if (!$conn) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	$sql = "DELETE FROM Pallet_Theme WHERE id='$id';";
	$result = mysqli_query($conn,$sql);
	$data = array();
	if(!$result)
		echo json_encode($data["theme"] = "false");
	else
		echo json_encode($data["theme"] = "true");

	$sql = "DELETE FROM Pallet_Library WHERE id='$id';";
	$result = mysqli_query($conn,$sql);
	if(!$result)
		echo json_encode($data["library"] = "false");
	else
		echo json_encode($data["library"] = "true");

	$sql = "DELETE FROM Pallet_Account WHERE id='$id';";
	$result = mysqli_query($conn,$sql);
	if(!$result)
		echo json_encode($data["account"] = "false");
	else
		echo json_encode($data["account"] = "true");

	mysqli_close($conn);

?>
