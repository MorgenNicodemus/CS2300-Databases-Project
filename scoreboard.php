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

    $scoreboard =  "SELECT t_name, score FROM team ORDER BY score DESC;";
    $result = mysqli_query($scoreboard);
    while($row = mysqli_fetch_array($result)) {
      echo "Team: ".$row['column1']." | ".$row['column2'];
    }
    ?>
    <ul class="navbar">
        <li><a href="puzzle.php">Puzzles</a></li>
        <li><a href="account.php">Account</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div align = "center">
    <h3> Scoreboard</h3>

    </div>
  </body>
</html>
