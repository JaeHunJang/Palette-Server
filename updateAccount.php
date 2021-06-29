<?php

	$id = $_POST["id"];
	$pw = $_POST["pw"];	
	$hint = $_POST["hint"];


	if($id==null || $pw==null || $hint==null){
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
	
	$sql = "UPDATE Pallet_Account SET pw='$pw',hint='$hint'WHERE id='$id';";
	$result = mysqli_query($conn,$sql);
	$data = array();
	if($result){
		$sql = "SELECT * FROM Pallet_Account WHERE id='$id' AND pw='$pw' AND hint='$hint';";
			$result = mysqli_query($conn,$sql);

			if(!$result)
				echo json_encode($data["flag"] = "false");
			else
				echo json_encode($data["flag"] = "true");
	}
	mysqli_close($conn);

?>
