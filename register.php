<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ReaverCTF Registration</title>
        <meta name="description" content="The register page of ReaverCTF">
        <link rel="stylesheet" href="assets/main.css">
    </head>
    <body>

<?php
	require 'setup.php';

	if (isset($_SESSION['usernamev3'])) { //Person is already logged in
		header('Location: puzzle.php');
		exit("You are already logged in. Redirecting to puzzle page..."); //Automatically closes MySQL connection and sends to logged in page
	}
	if (isset($_POST["register"]) and fieldExist()) {
		//Checks if user already exists
		$checkUser =  mysqli_prepare($databaseSQL, "SELECT user_name from reaver.player where user_name=?;");
		mysqli_stmt_bind_param($checkUser, 's', $name);

		$name = $_POST["username"]; //Grabs name and password entered from POST
		$password = $_POST["password"];
    #$team = $_POST["teamname"];
		mysqli_stmt_execute($checkUser); //System of prepared execution prevents SQL Injection
		$result = mysqli_stmt_get_result($checkUser);

//4.27 10:16am  - need to figure out how to check if a team with that name exists, if not create one, if so add user to team

		if (!mysqli_num_rows($result)) { //Only creates user if query SELECT returns no rows (so username is not in use)
			$checkUser =  mysqli_prepare($databaseSQL, "INSERT into reaver.player (user_name, pass) values (?, ?)");
			mysqli_stmt_bind_param($checkUser, 'ss', $name, $password);

			$name = $_POST["username"]; //Grabs name and password entered from POST after page redirect from home.html on submit
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

      if(mysqli_stmt_execute($checkUser)) { //Prevents SQL Injection?
			     echo "Account created with username {$name}.";
           header("location: login.php");
      } else {
        echo "Issue";
      }

		} else {
			echo "Username already in use.";
		}
		mysqli_stmt_free_result($checkUser);
		mysqli_stmt_close($checkUser);
	} else {

      echo '<div align = "center">
  		<br />
  		<br />
  		<br />
  		<h2> ReaverCTF Registration </h2>
  		<h3> Sign up for hours of puzzling enjoyment. </h3>
  <section class = "registerme">
  <form name = "register" action = "register.php" method = "post">
  		<ul>
  				<li> <label for = "username"> Username </label>
  						<input type = "text" name = "username" placeholder = "Username" required > </li>
  				<br />

  				<!-- <li> <label for = "teamname"> Team Name </label> -->
  				<!-- <input type = "text" name = "teamname" placeholder = "Team Name" required > -->

  				<div id = "passwordError"></div>
  			 <li> <label for = "password"> Password </label>
  				<input type = "password" name = "password" placeholder = "Password" id="password" > </li>
  				<br />
  				<li> <label for = "confirmpassword"> Confirm Password </label>
  				<input type = "password" name = "passwrd" placeholder = "Confirm Password" id = "confirmPassword" > </li>
  				<br />
  				<li> <input type="submit" value="Register" name="register"> </li>
  				</ul>
          </form>
  		 </section>
  		</div>
';

		echo '<form action="login.php">I already have an account.<input type="submit" value="Take me to login!" /></form>';
    echo '<form action="adminlogin.php">I already have an ADMIN account.<input type="submit" value="Take me to admin login!" /></form>';
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
