<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Capture the Flag Login</title>
        <meta name="description" content="The login page of Don't Fear The Reaver CTF">
        <link rel="stylesheet" href="pages/assets/main.css">
    </head>
    <body>

<?php
	require 'setup.php';

	if (isset($_SESSION['usernamev3'])) { //Person is already logged in
		header('Location: member.php');
		exit("You are already logged in. Redirecting to member page..."); //Automatically closes MySQL connection and sends to logged in page
	}

	if (isset($_POST["login"]) and fieldExist()) {
		//Login code copied on 2/24/18 from MySQL2-BasicLogin
		$checkUser =  mysqli_prepare($databaseSQL, "SELECT Password FROM users WHERE Email=?;");
		mysqli_stmt_bind_param($checkUser, 's', $name);

		$name = $_POST["username"]; //Grabs name and password entered from POST
		$password = $_POST["passwrd"];

		mysqli_stmt_execute($checkUser); //System of prepared execution prevents SQL Injection
		mysqli_stmt_store_result($checkUser);
		mysqli_stmt_bind_result($checkUser, $userPasswordHash);
		mysqli_stmt_fetch($checkUser);
		if (password_verify($_POST["passwrd"], $userPasswordHash)) {
			echo "Logged in.";
			$_SESSION['usernamev3'] = $name;
			header('Location: member.php');
			exit("Welcome. Redirecting to member page..."); //Automatically closes MySQL connection and sends to logged in page
		} else {
			echo "Username or password incorrect.";
		}
		mysqli_stmt_free_result($checkUser);
		mysqli_stmt_close($checkUser);
	} else { // Form generation if submit has not been pressed
		echo '<!DOCTYPE HTML>
		<html>
		<head><meta charset="utf-8">
		<title>FitBuds Login</title>
		<meta name="description" content="Login page!">
		<meta name="author" content="FitBuds"></head>
		<body>';
		// echo '<form action="login.php" method="post">
		// 	Username: <input type="text" name="username" required><br>
		// 	Password: <input type="password" name="passwrd" required><br>
		// 	<input type="submit" value="Login" name="login">
		// 	</form>';
    echo '		<br />
    		<br />
    		<div align = "center">
    		<h1> Welcome back to FitBuds! Please log in.</h1>
    		<section class = "logmein">
    		<form name = "login" action = "login.php" method = "post">
    		<ul>
    				<li> <label for = "usermail"> Email </label>
    						<input type = "email" name = "username" placeholder = "name@example.com" required> </li>
    				<br />
    			 <li> <label for = "password"> Password </label>
    				<input type = "password" name = "passwrd" placeholder = "Password" required> </li>
    				<br />
    				<li> <input type="submit" value="Login" name="login"> </li>
    				</ul>
    		 </form>
    		 </section>
    		</div>';
		echo '<form action="register.php">I don\'t have an account. <input type="submit" value="Take me to registration!" /></form>';
	}

	mysqli_close($databaseSQL); //Closes socket to MySQL! Important!

	function fieldExist() {
		if ($_POST["username"] !== "" and $_POST["passwrd"] !== "") {
			return true;
		} else {
			echo "You did not enter anything. Try again.";
			return false;
		}
	}
?>

	</body>
</html>
