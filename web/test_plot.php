<?php
	session_start();
	require_once "connect.php";
	unset($_SESSION['LoginError']);
	
	$conn = new mysqli($host,$db_user,$db_password,$db_name);
	$person = $_SESSION['user'];
	$query = "SELECT * FROM Measurement where user_id = (SELECT user_id from Users where u_nick = '$person')";
	$result = mysqli_query($conn, $query);
	$chart_data = '';
	while($row = mysqli_fetch_array($result))
	{
		$chart_data .= "{ Mes_date:'".$row["Mes_date"]."', temp1:".$row["temp1"].", temp2:".$row["temp2"]."}, ";
	}
	$chart_data = substr($chart_data, 0, -2);
	
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>User account </title>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body background="heaven3.jpg" >
	<center>
		<body style ="background-size:cover">
		<font color="#000000"/>
		<h1>
		<?php
			echo "Welcome ".$_SESSION['user'].'![<a href="logout.php">Logout</a>]';
		?>
		</h1>
		<body>
		<br /><br />
		<div class="container" style="width:1500px;">
			<h1 align="center">The chart below shows Your temperature measurement results</h1>  
			<br /><br />
		<div id="chart"></div>
		</div>	
	</center>
</body>
</html>
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'Mes_date',
 ykeys:['temp1', 'temp2'],
 labels:['Temp1', 'Temp2'],
 hideHover:'auto',
 stacked:false
});
</script>