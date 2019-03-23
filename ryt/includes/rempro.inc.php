<?php

session_start();

if (isset($_POST['remove_pro'])) {

    include_once 'dbh.inc.php';

    $pid = pg_escape_string($link, $_POST['pid']);

    if (empty($pid)) {
        header("Location: ../adminpanel.php?rempro=empty");
        exit();
    } else {
        $sql = "DELETE FROM PROJECTS WHERE projectid='$pid'";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?rempro=success");
        exit();
    }
} else {
    header("Location: ../index.php?rempro=forbidden");
    exit();
}
