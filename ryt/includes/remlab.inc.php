<?php

session_start();

if (isset($_POST['remove_lab'])) {

    include_once 'dbh.inc.php';

    $lid = pg_escape_string($link, $_POST['lid']);

    if (empty($lid)) {
        header("Location: ../adminpanel.php?remlab=empty");
        exit();
    } else {
        $sql = "DELETE FROM LABELS WHERE labelid='$lid'";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?remlab=success");
        exit();
    }
} else {
    header("Location: ../index.php?remlab=forbidden");
    exit();
}
