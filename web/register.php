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
		<h1 style="bold">Register Your Account</h1>
		
		<body style ="background-size:cover">
	
		<form action="registration.php" method="post" style="bold">
			Nick: <br/> <input type="text" name="nick"/> <br/><br/>
			Login: <br/> <input type="text" name="login"/> <br/><br/>
			Password: <br/> <input type="password" name="password"/> <br/><br/>
			E-mail: <br/> <input type="text" name="email"/> <br/><br/>
			<input type="submit" value="Register"/> <br/><br/>
		</form>
		
		<?php 
			if(isset($_SESSION['RegistrationError']))
			{
				echo $_SESSION['RegistrationError'];
				unset($_SESSION['RegistrationError']);
			}
			if(isset($_SESSION['fillErrorRegistration']))
			{
				echo $_SESSION['fillErrorRegistration'];
				unset($_SESSION['fillErrorRegistration']);
			}
			if(isset($_SESSION['TooShortNickError']))
			{
				echo $_SESSION['TooShortNickError'];
				unset($_SESSION['TooShortNickError']);
			}
			if(isset($_SESSION['TooShortLoginError']))
			{
				echo $_SESSION['TooShortLoginError'];
				unset($_SESSION['TooShortLoginError']);
			}
			if(isset($_SESSION['TooShortPasswordError']))
			{
				echo $_SESSION['TooShortPasswordError'];
				unset($_SESSION['TooShortPasswordError']);
			}
		?>
		
	</center>
	

</body>