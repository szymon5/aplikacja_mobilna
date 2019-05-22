<?php
	session_start();
	require_once "connect.php";
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>User account</title>
</head>

<body background="ocean3.jpg" >
	<center>
		<body style ="background-size:cover">
		<font color="#000000"/>
		<h1>
		<?php
			echo "Welcome ".$_SESSION['user'];
		?>
		</h1>
		<h2>The table below shows Your temperature measurement results</h2><br/><br/>
		
		
		<table border="1" cellpadding="6">
			<tr>
				<th><font style="bold"/>Temperature [°C]</th>
				<th><font style="bold"/>Date</th>
			</tr>
			<tr>
				<td> 29.111 </td> <td> 2019-20-04 </td>
			</tr>
		
		</table>
		
		
	</center>
	

</body>