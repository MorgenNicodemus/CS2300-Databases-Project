<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>ReaverCTF</title>
      <metaname="decription", content="ReaverCTF Puzzle">
      <link rel="stylesheet" href="assets/main.css">
  </head>
  <body>
    <ul class="navbar">
        <li><a href="puzzle.php">Puzzles</a></li>
        <li><a href="account.php">Account</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div align = "center">
    <h3> Scoreboard</h3>

    </div>
    <?php
    require 'setup.php';

    $scoreboard =  "SELECT t_name, score, rank()over( ORDER BY score DESC ) AS t_rank FROM reaver.team;";
    $result = mysqli_query($ReaverDB, $scoreboard);
    while($row = mysqli_fetch_assoc($result)) {
      echo "<h4><br>Rank: ".$row['t_rank']." | Team: ".$row['t_name']." | Score: ".$row['score']."</h4>";
    }
    ?>
  </body>
</html>
