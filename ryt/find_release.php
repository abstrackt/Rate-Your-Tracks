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
    <p>Find a release by name or release year:</p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="text" name="rnm" placeholder="Release name"> <br><br>
        <input type="text" name="rly" placeholder="Release date"> <br><br>
        <button type="submit" name="find_rel">Search</button>
    </form>
<div>

<?php

if (isset($_POST['find_rel'])) {
    $rnm = pg_escape_string($link, $_POST['rnm']);
    $rly = pg_escape_string($link, $_POST['rly']);

    if (empty($rnm) && empty($rly)) {
        unset($_POST['rnm']);
        unset($_POST['rly']);
        unset($_POST['find_rel']);
    } else {
        $result = pg_query($link, "SELECT * FROM releases WHERE false");
        $numrows = 0;
        if(!empty($rnm)) {
            $result = pg_query($link, "SELECT A.name, B.projectname, A.releaseid, A.releasedate, C.name AS labelname, A.releasetype 
                                       FROM releases A JOIN projects B ON A.projectid = B.projectid 
                                                       JOIN labels C ON A.releasedvia = C.labelid WHERE A.name = '$rnm'");
            $numrows = pg_numrows($result);
        } else {
            $result = pg_query($link, "SELECT A.name, B.projectname, A.releaseid, A.releasedate, C.name AS labelname, A.releasetype 
                                       FROM releases A JOIN projects B ON A.projectid = B.projectid 
                                                       JOIN labels C ON A.releasedvia = C.labelid WHERE date_part('year', releasedate) = '$rly'");
            $numrows = pg_numrows($result);
        }
        echo "<br><br>
              <table align=center>
              <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Project</th>
              <th>Release date</th>
              <th>Released via</th>
              <th>Release type</th>
              </tr>
              <tr>\n";
        for($ri = 0; $ri < $numrows; $ri++) {
        $row = pg_fetch_array($result, $ri);
        echo "
            <td>" . $row["releaseid"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["projectname"] . "</td>
            <td>" . $row["releasedate"] . "</td>
            <td>" . $row["labelname"] . "</td>
            <td>" . $row["releasetype"] . "</td>
            </tr>";
         }
         echo "</table>";
         unset($_POST['rnm']);
         unset($_POST['rly']);
         unset($_POST['find_rel']);
    }
}

?>
