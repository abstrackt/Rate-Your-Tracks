<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link href = "style.css" rel = "stylesheet" type = "text/css">
<body>

<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';
$result = pg_query($link, "SELECT * FROM releases JOIN projects ON releases.projectid = projects.projectid WHERE date_part('year', releasedate) = date_part('year', CURRENT_DATE);");
$numrows = pg_numrows($result);
?>

<div align=center>
  <h2>Welcome to Rate Your Tracks!</h2>
  <p>Top 10 new releases:</p>
  <table border="1" align=center>
  <tr>
   <th>Release</th>
   <th>Genre</th>
   <th>Project</th>
   <th>Released</th>
   <th>Type</th>
</tr>
</div>

<?php

 for($ri = 0; $ri < $numrows; $ri++) {
  echo "<tr>\n";
  $row = pg_fetch_array($result, $ri);
  echo " <td>" . $row["name"] . "</td>
 <td>" . $row["genre"] . "</td>
 <td>" . $row["projectname"] . "</td>
 <td>" . $row["releasedate"] . "</td>
 <td>" . $row["releasetype"] . "</td>
</tr>
";
 }

?>

</body>
</html>
