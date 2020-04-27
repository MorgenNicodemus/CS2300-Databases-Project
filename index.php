<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>ReaverCTF</title>
      <metaname="decription", content="ReaverCTF">
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

    if (isset($_POST["submit"])) {
		    $checkUser =  mysqli_prepare($databaseSQL, "SELECT Email, Password FROM users WHERE Email=? AND Password=?;");
		    mysqli_stmt_bind_param($checkUser, 'ss', $name, $password);

		    $name = $_POST["username"]; //Grabs name and password entered from POST after page redirect from home.html on submit
		    $password = $_POST["passwrd"];

		    mysqli_stmt_execute($checkUser); //Prevents SQL Injection?
        $result = mysqli_stmt_get_result($checkUser);

		    if (mysqli_num_rows($result))
        {
			       echo "Logged in.";
             header("Location: /home.html");
		    }
        else
        {
			       echo "Username or password incorrect.";
		    }

		mysqli_stmt_close($checkUser);
  }
    mysqli_close($databaseSQL);
    ?>
    <div align = "center">
    <h1> ReaverCTF</h1>
    <h3> Register now to start!</h3>
    <a href = "login.php" class = "button"> Log In </a>
    <a href = "register.php" class = "button"> Register </a>
    </div>
  </body>
</html>
