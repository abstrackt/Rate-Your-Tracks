<?php

session_start();

if (isset($_POST['remove_rel'])) {

    include_once 'dbh.inc.php';

    $rid = pg_escape_string($link, $_POST['rid']);

    if (empty($rid)) {
        header("Location: ../adminpanel.php?remrel=empty");
        exit();
    } else {
        $sql = "DELETE FROM PROJECTS WHERE projectid='$rid'";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?remrel=success");
        exit();
    }
} else {
    header("Location: ../index.php?remrel=forbidden");
    exit();
}
