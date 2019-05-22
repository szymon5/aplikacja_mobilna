<?php
	session_start();
	$_SESSION['login'] = 'szymon';
	$_SESSION['password'] = 'szy123';
	header('Location: test2.php');
?>