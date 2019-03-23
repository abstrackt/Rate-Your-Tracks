<?php
session_start();

?>

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
?>

<div class='search'>
    <p>Find a project by name:</p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="text" name="pnm" placeholder="Project name"> <br><br>
        <button type="submit" name="find_pro">Search</button>
    </form>
<div>

<?php

if (isset($_POST['find_pro'])) {
    $pnm = pg_escape_string($link, $_POST['pnm']);

    if (empty($pnm)) {
        unset($_POST['pnm']);
        unset($_POST['find_pro']);
    } else {
        $result = pg_query($link, "SELECT * FROM projects WHERE projectname = '$pnm'");
        $numrows = pg_numrows($result);
        
        echo "<br><br>
              <table align=center>
              <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Estabilished</th>
              <th>Disbanded</th>
              <th>Country of origin</th>
              </tr>
              <tr>\n";
        for($ri = 0; $ri < $numrows; $ri++) {
        $row = pg_fetch_array($result, $ri);
        echo "
            <td>" . $row["projectid"] . "</td>
            <td>" . $row["projectname"] . "</td>
            <td>" . $row["estabilished"] . "</td>
            <td>" . $row["disbanded"] . "</td>
            <td>" . $row["countryoforigin"] . "</td>
            </tr>";
         }
         echo "</table>";
         unset($_POST['pnm']);
         unset($_POST['find_pro']);
    }
}

?>
