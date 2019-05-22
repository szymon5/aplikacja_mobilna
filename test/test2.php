<?php
	session_start();
	
	$x = $_SESSION['login'];
	$y = $_SESSION['password'];
	
	echo $x." ".$y;
?>