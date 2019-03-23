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
$result = pg_query($link, "SELECT * FROM artists");
$numrows = pg_numrows($result);
?>

<h2 align=center>Here is a list of artists stored in the database.</h2>

<table border="1" align=center>
<tr>
 <th>Name</th>
 <th>Surname</th>
 <th>Alias</th>
 <th>Instrument</th>
 <th>Born</th>
 <th>Died</th>
</tr>

<?php

 for($ri = 0; $ri < $numrows; $ri++) {
  echo "<tr>\n";
  $row = pg_fetch_array($result, $ri);
  echo " <td>" . $row["name"] . "</td>
 <td>" . $row["surname"] . "</td>
 <td>" . $row["alias"] . "</td>
 <td>" . $row["instrument"] . "</td>
 <td>" . $row["born"] . "</td>
 <td>" . $row["died"] . "</td>
</tr>
";
 }

?>
