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
    <p>Find an artist by name or alias:</p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <input type="text" name="anm" placeholder="Artist's name"> <br><br>
        <input type="text" name="asr" placeholder="Artist's surname"> <br><br>
        <input type="text" name="ali" placeholder="Artist's alias"> <br><br>
        <button type="submit" name="find_art">Search</button>
    </form>
<div>

<?php

if (isset($_POST['find_art'])) {
    $anm = pg_escape_string($link, $_POST['anm']);
    $asr = pg_escape_string($link, $_POST['asr']);
    $ali = pg_escape_string($link, $_POST['ali']);

    if (empty($ali) && empty($anm) && empty($asr)) {
        unset($_POST['anm']);
        unset($_POST['asr']);
        unset($_POST['ali']);
        unset($_POST['find_art']);
    } else {
        $result = pg_query($link, "SELECT * FROM artists WHERE false");
        $numrows = 0;
        if(!empty($anm) || !empty($asr)) {
            if(!empty($anm) && empty($asr)) {
                $result = pg_query($link, "SELECT * FROM artists WHERE name = '$anm'");
                $numrows = pg_numrows($result);
            }
            if(empty($anm) && !empty($asr)) {
                $result = pg_query($link, "SELECT * FROM artists WHERE surname = '$asr'");
                $numrows = pg_numrows($result);
            }
            if(!empty($anm) && !empty($asr)) {
                $result = pg_query($link, "SELECT * FROM artists WHERE name = '$anm' AND surname = '$asr'");
                $numrows = pg_numrows($result);
            }
        } else {
            $result = pg_query($link, "SELECT * FROM artists WHERE alias = '$ali'");
            $numrows = pg_numrows($result);
        }
        echo "<br><br>
              <table align=center>
              <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Surname</th>
              <th>Alias</th>
              <th>Instrument</th>
              <th>Born</th>
              <th>Died</th>
              </tr>
              <tr>\n";
        for($ri = 0; $ri < $numrows; $ri++) {
        $row = pg_fetch_array($result, $ri);
        echo "
            <td>" . $row["artistid"] . "</td>
            <td>" . $row["name"] . "</td>
            <td>" . $row["surname"] . "</td>
            <td>" . $row["alias"] . "</td>
            <td>" . $row["instrument"] . "</td>
            <td>" . $row["born"] . "</td>
            <td>" . $row["died"] . "</td>
            </tr>";
         }
         echo "</table>";
         unset($_POST['anm']);
         unset($_POST['asr']);
         unset($_POST['ali']);
         unset($_POST['find_art']);
    }
}

?>
