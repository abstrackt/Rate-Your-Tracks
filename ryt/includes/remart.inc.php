<?php

session_start();

if (isset($_POST['remove_art'])) {

    include_once 'dbh.inc.php';

    $aid = pg_escape_string($link, $_POST['aid']);

    if (empty($aid)) {
        header("Location: ../adminpanel.php?remart=empty");
        exit();
    } else {
        $sql = "DELETE FROM ARTISTS WHERE artistid=$aid";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?remart=success");
        exit();
    }
} else {
    header("Location: ../index.php?remart=forbidden");
    exit();
}
