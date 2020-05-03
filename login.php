<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ReaverCTF Login</title>
        <meta name="description" content="ReaverCTF">
        <link rel="stylesheet" href="assets/main.css">
    </head>
    <body>

<?php
	require 'setup.php';

	if (isset($_SESSION['usernamev3'])) {
		header('Location: puzzle.php');
		exit("Redirecting to puzzles");
	}

	if (isset($_POST["login"]) and fieldExist()) {
		$checkUser =  mysqli_prepare($ReaverDB, "SELECT pass FROM player WHERE user_name=?;");
		mysqli_stmt_bind_param($checkUser, 's', $name);

		$name = $_POST["username"];
		$password = $_POST["password"];

		mysqli_stmt_execute($checkUser);
		mysqli_stmt_store_result($checkUser);
		mysqli_stmt_bind_result($checkUser, $userPasswordHash);
		mysqli_stmt_fetch($checkUser);
		if (password_verify($_POST["password"], $userPasswordHash)) {
			echo "Logged in.";
			$_SESSION['usernamev3'] = $name;
			header('Location: puzzle.php');
			exit("Redirecting to puzzles");
		} else {
			echo "Username or password incorrect.";
		}
		mysqli_stmt_free_result($checkUser);
		mysqli_stmt_close($checkUser);
	} else {
		echo '<!DOCTYPE HTML>
		<html>
		<head><meta charset="utf-8">
		<title>ReaverCTF Login</title>
		<meta name="description" content="Login page!">
		<meta name="author" content="ReaverCTF"></head>
		<body>';

    echo '		<br />
    		<br />
    		<div align = "center">
    		<h2> Welcome back to ReaverCTF! Please log in.</h2>
    		<section class = "logmein">
    		<form name = "login" action = "login.php" method = "post">
    		<ul>
    				<li> <label for = "usermail"> Username </label>
    						<input type = "text" name = "username" placeholder = "Username" required> </li>
    				<br />
    			 <li> <label for = "password"> Password </label>
    				<input type = "password" name = "password" placeholder = "Password" required> </li>
    				<br />
    				<li> <input type="submit" value="Login" name="login"> </li>
    				</ul>
    		 </form>
    		 </section>
    		</div>';
		echo '<form action="register.php">I don\'t have an account. <input type="submit" value="Take me to registration!" /></form>';
    
	}

	mysqli_close($ReaverDB);

	function fieldExist() {
		if ($_POST["username"] !== "" and $_POST["password"] !== "") {
			return true;
		} else {
			echo "You did not enter anything. Try again.";
			return false;
		}
	}
?>

	</body>
</html>
