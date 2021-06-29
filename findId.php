<?php
	$id = $_POST["id"];
	$birth = $_POST["birth"];
	$hint = $_POST["hint"];

	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null || $birth==null || $hint==null){
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

	

	$sql = "SELECT * FROM Pallet_Account WHERE id='$id' AND birth='$birth' AND hint='$hint';";
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장
	$data = array();
	if(!$result){
		//echo mysqli_error($result)."<br>";
		echo json_encode($data["flag"] = "false");
	}else{

		$count = mysqli_num_rows($result);
		if($count != 1)
		{
			//echo "Search Fail, Query rows num : $count<br>";
			echo json_encode($data["flag"] = "false");
			mysqli_close($conn);
			exit();
		}

		$sql = "UPDATE Pallet_Account SET pw='0000' WHERE id='$id';";
		$result = mysqli_query($conn,$sql);

		if(!$result)
			echo json_encode($data["flag"] = "false");
		else
			echo json_encode($data["flag"] = "true");
	}
	mysqli_close($conn);

?>
