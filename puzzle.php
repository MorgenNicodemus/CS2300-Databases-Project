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

    $puzzlelist =  "SELECT puzz_val, puzz_name, c_name, puzz_no FROM puzzle, p_belongs_to ORDER BY puzz_no DESC;";
    $result = mysql_query($puzzlelist);
    while($row = mysql_fetch_array($result)) {
      echo "Value: ".$row['column1']." | Name: ".$row['column2']." | Category: ".$row['column3'].;
    }
    ?>
    <ul class="navbar">
        <li><a href="puzzle.php">Puzzles</a></li>
        <li><a href="account.php">Account</a></li>
        <li><a href="scoreboard.php">Scoreboard</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div align = "center">
    <h3> ReaverCTF Puzzles</h3>

    </div>
  </body>
</html>
