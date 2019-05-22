<?php
	
	session_start();
	require_once "connect.php";
	unset($_SESSION['RegistrationError']);
	unset($_SESSION['fillErrorRegistration']);
	unset($_SESSION['fillErrorLogin']);
	unset($_SESSION['TooShortNickError']);
	unset($_SESSION['TooShortLoginError']);
	unset($_SESSION['TooShortPasswordError']);
	
	$conn = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($conn->connect_errno != 0)
	{
		echo "Error: ".$conn->connect_errno;
	}
	else
	{
		
		$nick = $_POST['nick'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		if(($nick || $login || $password || $email) == "")
		{
			$_SESSION['fillErrorRegistration'] = '<span style="color:red">You must fill all fields!</span>';
			header('location: register.php');
		}
		else
		{
			if((strlen($nick)>3) && (strlen($nick)< 16))
			{
				if((strlen($login)>3) && (strlen($login)< 16))
				{
					if((strlen($password)>3) && (strlen($password)< 16))
					{
						$sql = "select * from Users where u_login = '$login' and u_password = '$password' and u_nick = '$nick' and u_email = '$email' ";
						if($result = $conn->query($sql))
						{
							$usersq = $result->num_rows;
							if($usersq == 1)
							{
								$_SESSION['RegistrationError'] = '<span style="color:red">User already exists!</span>';
								
								header('location: register.php');
							}
							else
							{
								unset($_SESSION['RegistrationError']);
								unset($_SESSION['TooShortNickError']);
								unset($_SESSION['TooShortLoginError']);
								unset($_SESSION['TooShortPasswordError']);
								$nick = $_POST['nick'];
								$login = $_POST['login'];
								$password = $_POST['password'];
								$email = $_POST['email'];
								$sql = "insert into Users(u_login,u_password,u_nick,u_email) values('$nick','$login','$password','$email')";
								if($result = $conn->query($sql))
								{
									header('location: register_success.php');
								}
								else
								{
									header('location: register_failed.php');
								}
							}
						}
					}
					else
					{
						$_SESSION['TooShortPasswordError'] = '<span style="color:red">Too short Password! Have to be between 4 and 15 characters!</span>';
						header('location: register.php');
					}
				}
				else
				{
					$_SESSION['TooShortLoginError'] = '<span style="color:red">Too short Login! Have to be between 4 and 15 characters!</span>';
					header('location: register.php');
				}
			}
			else
			{
				$_SESSION['TooShortNickError'] = '<span style="color:red">Too short Nickname! Have to be between 4 and 15 characters!</span>';
				header('location: register.php');
			}
		}
		$conn->close();
	}
	
?>