<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>ReaverCTF - User Account</title>
      <metaname="decription", content="ReaverCTF Puzzle">
      <link rel="stylesheet" href="assets/main.css">
  </head>
  <body>
    <?php
    require 'setup.php';
    if (empty($_SESSION['usernamev3'])) {
    header('Location: login.php');
    exit("You are not logged in. Redirecting...");
    }
    if (!$ReaverDB) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = htmlentities($_SESSION['usernamev3']);
    $name = " ";

    $getScore = mysqli_stmt_init($ReaverDB);
    if(mysqli_stmt_prepare($getScore,"SELECT score FROM player WHERE user_name=?;")){
      mysqli_stmt_bind_param($getScore, "s", $username);
      mysqli_stmt_execute($getScore);
      mysqli_stmt_bind_result($getScore,$score);
      mysqli_stmt_fetch($getScore);
      mysqli_stmt_close($getScore);
    }

    $getTeam = mysqli_stmt_init($ReaverDB);
    if(mysqli_stmt_prepare($getTeam,"SELECT t_name FROM u_belongs_to, player WHERE user_name=? and player.user_name = u_belongs_to.u_name;")){
      mysqli_stmt_bind_param($getTeam, "s", $username);
      mysqli_stmt_execute($getTeam);
      mysqli_stmt_bind_result($getTeam,$team);
      mysqli_stmt_fetch($getTeam);
      mysqli_stmt_close($getTeam);
    }

    $getTeamS = mysqli_stmt_init($ReaverDB);
    if(mysqli_stmt_prepare($getTeamS,"SELECT score FROM team WHERE t_name=?;")){
      mysqli_stmt_bind_param($getTeamS, "s", $team);
      mysqli_stmt_execute($getTeamS);
      mysqli_stmt_bind_result($getTeamS,$teamS);
      mysqli_stmt_fetch($getTeamS);
      mysqli_stmt_close($getTeamS);
    }

    echo '    <body>
        <div align = "center">
        <h3> Account</h3>
        <!-- 4.27 10:16am  - need to figure out how to check if a team with that name exists, if not create one, if so add user to team  -->
        </div>
        <ul class="navbar">
            <li><a href="puzzle.php">Puzzles</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="scoreboard.php">Scoreboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
            <div class="column" id="profile">
                <h3> Username: ' . "$username" . '</h3>
                <h4> Player Score: '."$score".' | Team Name: '."$team".' | Team Score: '."$teamS".' </h4>
            </div>
        </div>';

?>
    </body>
</html>



  </body>
</html>
