<?php
	
	session_start();
	require_once "connect.php";
	unset($_SESSION['error']);
	
	if((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('location: main_page.php');
		exit();
	}
	else
	{
		$conn = new mysqli($host,$db_user,$db_password,$db_name);
	
		if($conn->connect_errno != 0)
		{
			echo "Error: ".$conn->connect_errno;
		}
		else
		{
			$login = $_POST['login'];
			$password = $_POST['password'];
			if(($login || $password) == "")
			{
				$_SESSION['fillErrorLogin'] = '<span style="color:red">You must fill all fields!</span>';
				header('location: main_page.php');
			}
			else
			{
				if($result = $conn->query(sprintf("select * from Users where u_login = '%s' and u_password = '%s'",mysqli_real_escape_string($conn,$login),mysqli_real_escape_string($conn,$password))))
				{
					$usersq = $result->num_rows;
					if($usersq == 1)
					{
						$row = $result->fetch_assoc();
						$_SESSION['user'] = $row['u_nick'];
						$_SESSION['id'] = $row['user_id'];
						$result->free_result();
						header('location: account.php');
					}
					else
					{
						$_SESSION['LoginError'] = '<span style="color:red">Incorrect login or password!</span>';
						header('location: main_page.php');
					}
				}
			}
			$conn->close();
		}
	}
	
	
	
?>