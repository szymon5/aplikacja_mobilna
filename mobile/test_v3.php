<?php
	
	session_start();
	require_once "connect.php";
	
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	
	$conn = new mysqli($host,$db_user,$db_password,$db_name);
	if($conn->connect_errno != 0)
	{
		echo "Error: ".$conn->connect_errno;
	}
	else
	{
		$sqlQuery = "select u_status from Users where u_login = 'szymon' and u_password = 'szy123' ";
		$result = $conn->query($sqlQuery);
		
		$users = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$user = array("u_status" => $row['u_status']);
			array_push($users,$user);
		}
		echo json_encode($users);
	}
		$conn->close();
	}
?>