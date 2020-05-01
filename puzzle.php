<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>ReaverCTF</title>
      <metaname="decription", content="ReaverCTF Puzzle">
      <link rel="stylesheet" href="assets/main.css">
  </head>
  <body>
    <?php
    require 'setup.php';

    if (empty($_SESSION['usernamev3'])) {
    header('Location: login.php');
    exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
    }
    $username = htmlentities($_SESSION['usernamev3']);
    $name = " ";
    $getPuzzleInfo =  "SELECT puzz_no, puzz_name, c_name, puzz_val, puzz_body FROM puzzle, p_belongs_to ORDER BY puzz_no DESC;";

    mysqli_stmt_execute($getPuzzleInfo);
    while ($result = mysqli_stmt_get_result($getPuzzleInfo)) {	// echo "<p>Welcome to the logged in area, {$username}!</p>";
      if ($row = mysqli_fetch_row($result)) {
        $puzzlenum = $row[0];
        $puzzlename = $row[1];
        $catname = $row[2];
        $puzzleval = $row[3];
        $puzzlebody = $row[4];
      }
      echo "\nPuzzle #: "."$puzzlenum"." | Name: "."$puzzlename"." | Category: "."$puzzlecat"." | Value: "."$puzzleval";
      echo "\nPuzzle: "."$puzzlebody";
  }

    if (isset($_POST["submitflag"]) and fieldExist()) {
      $checkFlag =  mysqli_prepare($ReaverDB, "SELECT puzz_flag FROM puzzle WHERE puzz_no=?;");
      mysqli_stmt_bind_param($checkFlag, 's', $puzzlenumber);

      $puzzlenumber = $_POST["puzzlenumber"];
      $puzzleflag = $_POST["puzzleflag"];

      mysqli_stmt_execute($checkFlag);
      mysqli_stmt_store_result($checkFlag);
      mysqli_stmt_bind_result($checkFlag, $flagResult);
      mysqli_stmt_fetch($checkFlag);
      if (password_verify($_POST["puzzleflag"], $flagResult)) {
        echo "Flag is Correct!";
        //Add entry to solved by team and user
      } else {
        echo "Username or password incorrect.";
      }
      mysqli_stmt_free_result($checkUser);
      mysqli_stmt_close($checkUser);
    } else {
      echo '<!DOCTYPE HTML>
      <html>
      <head><meta charset="utf-8">
      <title>Puzzle Submission</title>
      <meta name="description" content="Logi!">
      <meta name="author" content="ReaverCTF"></head>
      <body>
      <ul class="navbar">
          <li><a href="puzzle.php">Puzzles</a></li>
          <li><a href="account.php">Account</a></li>
          <li><a href="scoreboard.php">Scoreboard</a></li>
          <li><a href="logout.php">Logout</a></li>
      </ul>
      <div align = "center">
      <h3> ReaverCTF Puzzles</h3>

      </div>';

      echo '		<br />
          <br />
          <div align = "center">
          <h2> Submit your puzzle here. </h2>
          <section class = "submitaflag">
          <form name = "submitflag" action = "puzzle.php" method = "post">
          <ul>
              <li> <label for = "puzzlenumber"> Puzzle Number </label>
                  <input type = "integer" name = "puzzlenumber" placeholder = "Puzzle Number" required> </li>
              <br />
             <li> <label for = "puzzleflag"> Flag </label>
              <input type = "text" name = "puzzleflag" placeholder = "reaverCTF{flag}" required> </li>
              <br />
              <li> <input type="submit" value="Submit Flag" name="flagsubmit"> </li>
              </ul>
           </form>
           </section>
          </div>';
    }
    ?>
  </body>
</html>
