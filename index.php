<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>ReaverCTF!</title>
      <metaname="decription", content="Login to ReaverCTF">
            <link rel="stylesheet" href="assets/main.css">
  </head>
  <body>
    <?php

    error_reporting(-1);
	  ini_set('display_errors', 'On');

    $databaseSQL = mysqli_connect('localhost', 'root', 'SammieIsLife123', 'reaver');
    if (!$databaseSQL) {
		    trigger_error('Could not connect to MySQL: '.mysqli_connect_error() );
	  }


    ?>
    <div align = "center"
    <h1> Yuh </h1>
    <h3> Register now to start! </h3>
    </div>
  </body>
</html>
