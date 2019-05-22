<?php
	session_start();
	require_once "connect.php";
	
	if(isset($_POST['Login']) && isset($_POST['Password']))
	{
		$_Login = $_POST['Login'];
		$_Password = $_POST['Password'];
		
		$conn = new mysqli($host,$db_user,$db_password,$db_name);
		
		if($conn->connect_errno != 0)
		{
			echo "Error: ".$conn->connect_errno;
		}
		else
		{
			$sqlQuery = "select * from Users where u_login = '$_Login' and u_password = '$_Password'";
			if($result = $conn->query($sqlQuery))
			{
				$quantity = $result->num_rows;
				if($quantity == 1)
				{
					$_SESSION['login'] = $_Login;
					$_SESSION['password'] = $_Password;
					$update = "update Users set u_status = 'online' where u_login = '$_Login'";
					$conn->query($update);
					$row = mysqli_fetch_assoc($update);
					echo $row['u_status'];
				}
			}
			$conn->close();
		}
	}
?>