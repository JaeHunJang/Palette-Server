<?php
	$id = $_GET["id"];
	$pw = $_GET["pw"];

	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null || $pw==null){
		echo "_GET ERROR<br>";
		exit();
	}

	$host = 'localhost';//ip �ּ�
	$user = 'wuddlaa';
	$pw = 'roqkfwk!2';
	$dbName = 'wuddlaa';
	$conn = mysqli_connect($host, $user, $pw, $dbName); //��� ����� ����

	if (!$conn) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}

	
	$sql = "SELECT * FROM Pallet_Account WHERE id='$id' AND pw='$pw';";
	$result=mysqli_query($conn,$sql); //���� ������ ����

	if(!$result)
		echo mysqli_error($result)."<br>";
	else{
		$count = mysqli_num_rows($result);
		$data = array();
		if($count == 1)
			echo json_encode($data["flag"] = "false");
		else
			echo json_encode($data["flag"] = "true");

	}
	
	mysqli_close($conn);

?>
