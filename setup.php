<?php
	session_start();
	date_default_timezone_set('America/Chicago');

	error_reporting(1);
	ini_set('display_errors', 'On');

	$ReaverDB = mysqli_connect('localhost', 'root', 'SammieIsLife123', 'reaver');
	if (!$ReaverDB) {
		trigger_error('Could not connect to database: '.mysqli_connect_error() );
	}
?>
