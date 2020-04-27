<?php
	session_start(); //Starts PHP session
	date_default_timezone_set('America/Chicago');


	//Optional error printing code
	error_reporting(1);
	ini_set('display_errors', 'On');

	// Make the main SQL connection:
	$databaseSQL = mysqli_connect('localhost', 'root', 'SammieIsLife123', 'reaver');
	if (!$databaseSQL) { //Triggered if databaseSQL is null and shows error
		trigger_error('Could not connect to MySQL: '.mysqli_connect_error() );
	}
?>
