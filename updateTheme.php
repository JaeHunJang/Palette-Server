<?php

	$id = $_POST["id"];
	$library = $_POST["library"];
	$name = $_POST["name"];
	$color = $_POST["color"];
	$date = $_POST["date"];
	$tags = $_POST["tags"];
	$num = $_POST["num"];
	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null ||$library==null ||$name==null ||$color==null ||$date==null ||$tags==null||$num==null){
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
	
	$sql = "UPDATE Pallet_Theme SET id='$id', library='$library',name='$name',color='$color',date='$date',tags='$tags' WHERE num='$num';";
	$result = mysqli_query($conn,$sql);
	$data = array();

	if($result){
		$sql = "SELECT * FROM Pallet_Theme WHERE id='$id' AND library='$library' AND name='$name' AND color='$color'AND date='$date'AND tags='$tags';";
			$result = mysqli_query($conn,$sql);

			if(!$result)
				echo json_encode($data["flag"] = "false");
			else
				echo json_encode($data["flag"] = "true");
	}
	mysqli_close($conn);

?>
