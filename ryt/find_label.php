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
    <p>Find a label by name:</p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="text" name="lnm" placeholder="Label name"> <br><br>
        <button type="submit" name="find_lab">Search</button>
    </form>
<div>

<?php

if (isset($_POST['find_lab'])) {
    $lnm = pg_escape_string($link, $_POST['lnm']);

    if (empty($lnm)) {
        unset($_POST['lnm']);
        unset($_POST['find_lab']);
    } else {
        $result = pg_query($link, "SELECT * FROM labels WHERE name = '$lnm'");
        $numrows = pg_numrows($result);
        
        echo "<br><br>
              <table align=center>
              <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Main genre</th>
              <th>Estabilished</th>
              <th>Based in</th>
              <th>Netlabel?</th>
              </tr>
              <tr>\n";
        for($ri = 0; $ri < $numrows; $ri++) {
        $row = pg_fetch_array($result, $ri);
        echo "
            <td>" . $row["labelid"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["genre"] . "</td>
            <td>" . $row["estabilished"] . "</td>
            <td>" . $row["basedin"] . "</td>
            <td>" . $row["isnetlabel"] . "</td>
            </tr>";
         }
         echo "</table>";
         unset($_POST['lnm']);
         unset($_POST['find_lab']);
    }
}

?>

<div class='search'>
    <p>Find a label by country:</p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="text" name="lct" placeholder="Label country of origin"> <br><br>
        <button type="submit" name="find_lct">Search</button>
    </form>
<div>

<?php

if (isset($_POST['find_lct'])) {
    $lct = pg_escape_string($link, $_POST['lct']);

    if (empty($lct)) {
        unset($_POST['lct']);
        unset($_POST['find_lab']);
    } else {
        $result = pg_query($link, "SELECT * FROM labels WHERE basedin = '$lct'");
        $numrows = pg_numrows($result);
        
        echo "<br><br>
              <table align=center>
              <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Main genre</th>
              <th>Estabilished</th>
              <th>Based in</th>
              <th>Netlabel?</th>
              </tr>
              <tr>\n";
        for($ri = 0; $ri < $numrows; $ri++) {
        $row = pg_fetch_array($result, $ri);
        echo "
            <td>" . $row["labelid"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["genre"] . "</td>
            <td>" . $row["estabilished"] . "</td>
            <td>" . $row["basedin"] . "</td>
            <td>" . $row["isnetlabel"] . "</td>
            </tr>";
         }
         echo "</table>";
         unset($_POST['lct']);
         unset($_POST['find_lab']);
    }
}

?>
