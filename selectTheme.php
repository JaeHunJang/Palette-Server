<?php
	$id = $_POST["id"];
	$num = $_POST["num"];
	$checked = $_POST["checked"];
	$keyword = $_POST["keyword"];

	//$id = $_POST["id"];
	//$pw = $_POST["pw"];

	if($id==null||$num==null||$checked==null){
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

	$sql;
	{
		switch ($num) {
			case "0":
				if ($checked == "0") {
					$sql = "SELECT * FROM Pallet_Theme WHERE (name LIKE '%".$keyword."%'  OR tags LIKE '%".$keyword."%')AND id = '".$id."' ORDER BY date DESC";
					break;
				}
				$sql = "SELECT * FROM Pallet_Theme WHERE (name LIKE '%".$keyword."%'  OR tags LIKE '%".$keyword."%') ORDER BY date DESC";
				break;
			case "1":
				if ($checked == "0") {
					$sql = "SELECT * FROM Pallet_Theme WHERE (name LIKE '%".$keyword."%'  OR tags LIKE '%".$keyword."%')AND id = '$id' ORDER BY date";
					break;
				}
				$sql = "SELECT * FROM Pallet_Theme WHERE (name LIKE '%".$keyword."%'  OR tags LIKE '%".$keyword."%') ORDER BY date";
				break;
			case "2":
				$sql = "SELECT * FROM Pallet_Theme WHERE id = '$id' AND library='$keyword' ORDER BY date";
				break;
		}
	}
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장

	if(!$result){
		echo mysqli_error($result)."<br>";
		mysqli_close($conn);
		exit();
	}
	else{
		$data = array();    
		while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$data[] = $row;
		}

		$json = json_encode($data,JSON_UNESCAPED_UNICODE);
		echo $json;
	}
	
	switch (json_last_error()) {
        case JSON_ERROR_NONE:
            //echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }
	mysqli_close($conn);

?>
