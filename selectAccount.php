<?php
	$id = $_POST["id"];

	if($id==null){
		echo "Parameters ERROR<br>";
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

	$sql = "SELECT * FROM Pallet_Account WHERE id like ('$id');";
	$result=mysqli_query($conn,$sql); //쿼리 수행결과 저장

	if(!$result)
		echo mysqli_error($result)."<br>";
	else{
		$count = mysqli_num_rows($result);

		if($count == 0){
			echo "Library List Empty, Query rows num : $count<br>";
			mysqli_close($conn);
			exit();
		}
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
