<?php

	$id = $_POST["id"];
	$library = $_POST["library"];
	$name = $_POST["name"];
	$num = $_POST["num"];
	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null ||$library==null ||$name==null ||$num==null){
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
	
	$sql = "DELETE FROM Pallet_Theme WHERE num='$num' AND id='$id' AND library='$library' AND name='$name';";
	$result = mysqli_query($conn,$sql);
	$data = array();

	if(!$result)
			echo json_encode($data["flag"] = "false");
		else
			echo json_encode($data["flag"] = "true");

	mysqli_close($conn);

?>
