<?php
	require 'setup.php';
	unset($_SESSION['usernamev3']);
	mysqli_close($ReaverDB);
	header('Location: index.php');
	exit("Logged out and redirecting to login page.");
?>
