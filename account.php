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
    exit("You are not logged in. Redirecting..."); //Kicks off and automatically closes MySQL connection
    }

    $username = htmlentities($_SESSION['usernamev3']);
    $name = " ";
    $getUserInfo =  "SELECT user_name, player.score, t_name, team.score FROM player, u_belongs_to, team WHERE player.user_name = ?;";
    mysqli_stmt_bind_param($getUserInfo, 's', $username);

    mysqli_stmt_execute($getUserInfo);

    if ($result = mysqli_stmt_get_result($getUserInfo)) {
      echo "here";	// echo "<p>Welcome to the logged in area, {$username}!</p>";
      if ($row = mysqli_fetch_row($result)) {
        $name = $row[0];
        $playerscore = $row[1];
        $teamname = $row[2];
        $teamscore = $row[3];
      }
    else{
      echo "Issue retrieving account";
    }
    echo "ello";
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
                <h4> Player Score: '."$playerscore".' | Team Name: '."$teamname".' | Team Score: '."$teamscore".' </h4>
            </div>
        </div>';
?>
    </body>
</html>



  </body>
</html>
