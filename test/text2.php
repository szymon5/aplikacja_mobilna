<?php
	session_start();
	
	$x = $_SESSION['x'];
	$y = $_SESSION['y'];
	
	echo $x." ".$y;
?>