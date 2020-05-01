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

    //4/30 --- how to figure out who the user that is logged in is (P)
    $getUserInfo =  "SELECT user_name, player.score, t_name, team.score FROM player, u_belongs_to, team;";
    $result = mysql_query($getUserInfo);

    echo "Username: ".$row['column1']." | Player Score: ".$row['column2']." | Team Name: ".$row['column3']." | Team Score: ".$row['column4'].;

    mysqli_close($ReaverDB);

    ?>
    <ul class="navbar">
        <li><a href="puzzle.php">Puzzles</a></li>
        <li><a href="account.php">Account</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div align = "center">
    <h3> Account</h3>
    <!-- 4.27 10:16am  - need to figure out how to check if a team with that name exists, if not create one, if so add user to team  -->
    </div>
  </body>
</html>
