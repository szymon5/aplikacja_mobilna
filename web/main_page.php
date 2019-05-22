<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Check the temperature measurement</title>
</head>

<body background="earth7.jpg" >
	<center>
		<font color="#000000"/>
		<h1>Welcome in the temperature measurement website</h1>
		
		<body style ="background-size:cover">
	
		<form action="login.php" method="post">
		
			Login: <br/> <input type="text" name="login"/> <br/><br/>
			Password: <br/> <input type="password" name="password"/> <br/><br/>
			<input type="submit" value="Login"/> <br/><br/>
		</form>
		<form action="register.php" method="post">
			<input type="submit" value="Register"/>
		</form>
		<?php 
			if(isset($_SESSION['LoginError']))
			{
				echo $_SESSION['LoginError'];
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['fillErrorLogin']))
			{
				echo $_SESSION['fillErrorLogin'];
				unset($_SESSION['fillErrorLogin']);
			}
		?>
	</center>
	

</body>