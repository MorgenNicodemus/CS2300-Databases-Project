<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>ReaverCTF</title>
      <metaname="decription", content="ReaverCTF Puzzle">
      <link rel="stylesheet" href="assets/main.css">
  </head>
  <body>
    <!DOCTYPE HTML>
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
    </div>
    <?php
    require 'setup.php';

    if (empty($_SESSION['usernamev3'])) {
    header('Location: login.php');
    exit("You are not logged in. Redirecting...");
    }
    $username = htmlentities($_SESSION['usernamev3']);
    $name = " ";
    $getPuzzleInfo =  "SELECT puzz_no, puzz_name, c_name, puzz_val, puzz_body FROM puzzle, p_belongs_to WHERE puzzle.puzz_no = p_belongs_to.p_no ORDER BY puzz_no ASC;";

    //if(mysqli_stmt_execute($getPuzzleInfo));
    $result = mysqli_query($ReaverDB, $getPuzzleInfo);

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Puzzles</h2>";
      while($row = mysqli_fetch_assoc($result)) {
        echo "<br>Puzzle Number " .$row["puzz_no"]." | ".$row["c_name"] . " | " . $row["puzz_name"] . " | " . $row["puzz_val"] . " Points | ".$row["puzz_body"];
      }
    }

    if (isset($_POST["submitflag"]) {
      $checkFlag =  mysqli_prepare($ReaverDB, "SELECT puzz_flag FROM puzzle WHERE puzz_no=?;");
      mysqli_stmt_bind_param($checkFlag, 'i', $puzzlenumber);

      $puzzlenumber = $_POST["puzzlenumber"];
      $puzzleflag = $_POST["puzzleflag"];

      mysqli_stmt_execute($checkFlag);
      mysqli_stmt_store_result($checkFlag);
      mysqli_stmt_bind_result($checkFlag, $flagResult);
      mysqli_stmt_fetch($checkFlag);
      if (password_verify($_POST["puzzleflag"], $flagResult)) {
        echo "Flag is Correct!";

        //add puzzle to team has solved list
        $checkFlag =  mysqli_prepare($ReaverDB, "INSERT into reaver.t_has_solved (t_name, puzz_no) values (?, ?)");
        mysqli_stmt_bind_param($checkFlag, 'si', $team, $puzzlenumber);
        $team = $_POST["teamname"];
        $puzzlenumber = $_POST["puzzlenumber"];
        mysqli_stmt_execute($checkFlag);

        //increment team score
        $checkFlag =  mysqli_prepare($ReaverDB, "SELECT puzz_val FROM puzzle WHERE puzz_no = ?");
        mysqli_stmt_bind_param($checkFlag, 'i', $puzzlenumber);
        $puzzlenumber = $_POST["puzzlenumber"];
        mysqli_stmt_execute($checkFlag);
        mysqli_stmt_store_result($checkFlag);
        mysqli_stmt_bind_result($checkFlag, $puzzleValue);
        //mysqli_stmt_fetch($checkFlag);
        $checkFlag =  mysqli_prepare($ReaverDB, "UPDATE reaver.team SET (score = score + ?) WHERE t_name = ?");
        mysqli_stmt_bind_param($checkFlag, 'ii', $puzzleValue, $puzzlenumber);
        $puzzlenumber = $_POST["puzzlenumber"];
        mysqli_stmt_execute($checkFlag);

        //Adjust team rankings (note- this may need to be done in CTE view, not directly to the table)
        //mysqli_prepare($ReaverDB, "SELECT t_name, score,
                                            //RANK() OVER (ORDER BY score DESC) AS t_rank
                                  // FROM reaver.team
                                  // UPDATE reaver.team SET 'rank' = t_rank");
      } else {
        echo "Flag is Incorrect.";
      }
      mysqli_stmt_free_result($checkFlag);
      mysqli_stmt_close($checkFlag);


    } else {
      echo '
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
           <li> <label for = "teamname"> Team Name </label>
            <input type = "text" name = "teamname" placeholder = "Team Name" required> </li>
            <br />
            <li> <input type="submit" value="Submit Flag" name="submitflag"> </li>
            </ul>
         </form>
         </section>
        </div>';
    }
    ?>
  </body>
</html>
