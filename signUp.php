<?php
	$id = $_POST["id"];
	$pw = $_POST["pw"];	
	$birth = $_POST["birth"];
	$hint = $_POST["hint"];

	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null || $pw==null || $birth==null || $hint==null){
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

	$sql = "SELECT * FROM Pallet_Account WHERE id='$id';";
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장
	
	$data = array();
	if(!$result)
		echo mysqli_error($result)."<br>";
	else{

		$count = mysqli_num_rows($result);

		if($count > 0){ //id Overlap check
			//echo "ID Overlap, Query rows num : $count<br>";
			echo json_encode($data["overlap"] = "overlap");
		}else{

			{ //insert account
				$sql = "INSERT INTO Pallet_Account VALUES('$id','$pw','$birth','$hint');";
				mysqli_query($conn,$sql);

				$sql = "SELECT * FROM Pallet_Account WHERE id='$id' AND pw='$pw' AND birth='$birth' AND hint='$hint';";
				$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장

				if(!$result)
					echo mysqli_error($result)."<br>";
				
				$count = mysqli_num_rows($result);

				if($count != 1){
					//echo "Account Insert Fail, Query rows num : $count<br>";
					echo json_encode($data["flag"] = "false");
					mysqli_close($conn);
				}
			}

			{ //insert library
				$sql = "INSERT INTO Pallet_Library VALUES('$id','Default');";
				mysqli_query($conn,$sql);
				
				$sql = "SELECT * FROM Pallet_Library WHERE id='$id' AND library='default';";
				$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장

				if(!$result)
					echo mysqli_error($result)."<br>";
				
				$count = mysqli_num_rows($result);

				if($count != 1)
				{
					//echo "Library Insert Fail, Query rows num : $count<br>";
					echo json_encode($data["flag"] = "false");
					mysqli_close($conn);
				}
			}
			echo json_encode($data["flag"] = "true");
		}
	}
	mysqli_close($conn);

?>
