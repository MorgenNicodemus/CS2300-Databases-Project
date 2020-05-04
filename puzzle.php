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
        echo "<br><h4>Puzzle Number " .$row["puzz_no"]." | ".$row["c_name"] . " | " . $row["puzz_name"] . " | " . $row["puzz_val"] . " Points | ".$row["puzz_body"]."</h4>";
      }
    }

    if (isset($_POST["submitflag"])) {
      $checkFlag =  mysqli_prepare($ReaverDB, "SELECT puzz_flag FROM puzzle WHERE puzz_no=?;");
      mysqli_stmt_bind_param($checkFlag, 'i', $puzzlenumber);

      $puzzlenumber = $_POST["puzzlenumber"];
      $puzzleflag = $_POST["puzzleflag"];

      mysqli_stmt_execute($checkFlag);
      mysqli_stmt_store_result($checkFlag);
      mysqli_stmt_bind_result($checkFlag, $flagResult);
      mysqli_stmt_fetch($checkFlag);

      $checkFlag = mysqli_prepare($ReaverDB, "SELECT t_name FROM t_has_solved WHERE t_name = ? AND p_number = ?");
      mysqli_stmt_bind_param($checkFlag, 'si', $team, $puzzlenumber);
      $team = $_POST["teamname"];
      $puzzlenumber = $_POST["puzzlenumber"];
      mysqli_stmt_execute($checkFlag);
      $submitResult = mysqli_stmt_get_result($checkFlag);

      if (($_POST["puzzleflag"] == $flagResult) and !mysqli_num_rows($submitResult)) {
        echo "<br><h3>Flag is Correct!</h3>";

        //add puzzle to team has solved list
        $checkFlag =  mysqli_prepare($ReaverDB, "INSERT into reaver.t_has_solved (t_name, p_number) values (?, ?)");
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
        mysqli_stmt_fetch($checkFlag);
        $checkFlag =  mysqli_prepare($ReaverDB, "UPDATE reaver.team SET score = score + ? WHERE t_name = ?");
        mysqli_stmt_bind_param($checkFlag, 'is', $puzzleValue, $team);
        $team = $_POST["teamname"];
        mysqli_stmt_execute($checkFlag);

        //add puzzle to user has solved list
        $checkFlag =  mysqli_prepare($ReaverDB, "INSERT into reaver.u_has_solved (u_name, p_number) values (?, ?)");
        mysqli_stmt_bind_param($checkFlag, 'si', $username, $puzzlenumber);
        $username = htmlentities($_SESSION['usernamev3']);
        $puzzlenumber = $_POST["puzzlenumber"];
        mysqli_stmt_execute($checkFlag);

        //increment user score
        $checkFlag =  mysqli_prepare($ReaverDB, "SELECT puzz_val FROM puzzle WHERE puzz_no = ?");
        mysqli_stmt_bind_param($checkFlag, 'i', $puzzlenumber);
        $puzzlenumber = $_POST["puzzlenumber"];
        mysqli_stmt_execute($checkFlag);
        mysqli_stmt_store_result($checkFlag);
        mysqli_stmt_bind_result($checkFlag, $puzzleValue);
        mysqli_stmt_fetch($checkFlag);
        $checkFlag =  mysqli_prepare($ReaverDB, "UPDATE reaver.player SET score = score + ? WHERE user_name = ?");
        mysqli_stmt_bind_param($checkFlag, 'is', $puzzleValue, $username);
        $username = htmlentities($_SESSION['usernamev3']);
        mysqli_stmt_execute($checkFlag);

        //Adjust team rankings
      //  $checkFlag =  "SELECT t_name, score, RANK() OVER (ORDER BY score DESC) AS t_rank FROM reaver.team";
      //  $result = mysqli_query($checkFlag);
        //while($row = mysqli_fetch_array($result)) {
        $checkFlag = "UPDATE reaver.team
        JOIN (SELECT p.t_name, IF(@lastScore <> p.score,
                                    @curRank := @curRank + 1,
                                    @curRank) AS rank,
                                IF(@lastScore = p.score,
                                    @curRank := @curRank + 1,
                                    @curRank),
                                  @lastScore := p.score
              FROM   reaver.team p
              JOIN    (SELECT @curRank := 0, @lastScore := 0) r
              ORDER BY p.score DESC)
              ranks ON (ranks.t_name = reaver.team.t_name)
        SET    reaver.team.rank = ranks.rank";
        //$checkFlag = "UPDATE reaver.team
                    //  SET team.rank = T.rank FROM reaver.team
                    //  INNER JOIN
                    //  (SELECT score rank() over(ORDER BY score) team.rank
                    //  FROM reaver.team) AS T
                    //  ON reaver.team.score = T.score";
            //}
        //  mysqli_stmt_bind_param($checkFlag, 'is', $rank, $team);
      //    $rank = $row['t_rank'];
        //  $team = $row['t_name'];
          mysqli_stmt_execute($checkFlag);

      } elseif(mysqli_num_rows($submitResult)){
        echo "<br><h3>Already solved by your team.</h3>";
      }
        else {
        echo "<br><h3>Flag is Incorrect.</h3>";
      }
      mysqli_stmt_free_result($checkFlag);
      mysqli_stmt_close($checkFlag);


    } else {
      echo '
        <div align = "center">
        <h3> Submit your puzzle here. </h3>
        <section class = "submitaflag">
        <form name = "submitflag" action = "puzzle.php" method = "post">
            <li> <label for = "puzzlenumber"> Puzzle Number </label>
                <input type = "number" name = "puzzlenumber" placeholder = "Puzzle Number" required> </li>
            <br />
           <li> <label for = "puzzleflag"> Flag </label>
            <input type = "text" name = "puzzleflag" placeholder = "reaverCTF{flag}" required> </li>
            <br />
           <li> <label for = "teamname"> Team Name </label>
            <input type = "text" name = "teamname" placeholder = "Team Name" required> </li>
            <br />
            <li> <input type="submit" value="Submit Flag" name="submitflag"> </li>
         </form>
         </section>
        </div>';
    }
    ?>
  </body>
</html>
