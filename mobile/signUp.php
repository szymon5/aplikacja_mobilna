<?php
	
	require_once "connect.php";
	
	if(isset($_POST['Login']) && isset($_POST['Password']) && isset($_POST['Nick']) && isset($_POST['Email']))
	{
		$_Login = $_POST['Login'];
		$_Password = $_POST['Password'];
		$_Nick = $_POST['Nick'];
		$_Email = $_POST['Email'];
		
		$conn = new mysqli($host,$db_user,$db_password,$db_name);
	
		if($conn->connect_errno != 0)
		{
			echo "Error: ".$conn->connect_errno;
		}
		else
		{
			$u_id = $_SESSION['id'];
			$sqlQuery = "Insert into Users(u_login,u_password,u_nick,u_email) values('$_Login','$_Password','$_Nick','$_Email')";
			
			if($result = $conn->query($sqlQuery))
			{
				$newID = "select max(user_id) as NewID from Users";
				$conn->query($newID);
				$row = mysqli_fetch_assoc($newID);
				
				echo $row['NewID'];
			}
			$conn->close();
		}
		
	}
	
	
	
?>