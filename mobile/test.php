<?php
	
	//session_start();
	require_once "connect.php";
	//unset($_SESSION['error']);
	
	$conn = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($conn->connect_errno != 0)
	{
		echo "Error: ".$conn->connect_errno."Opis: ".connect_error;
	}
	else
	{
		$sql = "select * from Users where u_login = 'szymon' and u_password = 'szy123' ";
		if($result = $conn->query($sql))
		{
			$usersq = $result->num_rows;
			if($usersq == 1)
			{
				$users = array();
				while($row = mysqli_fetch_assoc($result))
				{
					$user = array("u_status" => $row['u_status'],
								   "u_email" => $row['u_email']
								   );
					array_push($users,$user);
				}
			echo json_encode($users);
			}
		}
		$conn->close();
	}
	
	
	
?>