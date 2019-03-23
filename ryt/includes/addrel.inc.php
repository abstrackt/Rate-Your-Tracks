<?php

session_start();

if (isset($_POST['submit_rel'])) {

    include_once 'dbh.inc.php';

    $pid = pg_escape_string($link, $_POST['pid']);
    $rnm = pg_escape_string($link, $_POST['rnm']);
    $gnr = pg_escape_string($link, $_POST['gnr']);
    $rld = pg_escape_string($link, $_POST['rld']);
    $lid = pg_escape_string($link, $_POST['lid']);
    $type = pg_escape_string($link, $_POST['type']);

    if (empty($pid) || empty($rnm) || empty($gnr) || empty($rld) || empty($lid) || empty($type)) {
        header("Location: ../adminpanel.php?addrel=empty");
        exit();
    } else {
        $sql1 = "SELECT * FROM projects WHERE projectid='$pid'";
        $result1 = pg_query($link, $sql1);
        $check1 = pg_numrows($result1);

        $sql2 = "SELECT * FROM labels WHERE labelid='$lid'";
        $result2 = pg_query($link, $sql2);
        $check2 = pg_numrows($result2);

        if ($check1 == 1 && $check2 == 1) {
            $sql = "INSERT INTO RELEASES(projectid, name, genre, releasedate, releasedvia, releasetype) 
                    VALUES ('$pid', '$rnm', '$gnr', '$rld', '$lid', '$type');";
            pg_query($link, $sql);
            header("Location: ../adminpanel.php?addrel=success");
            exit();
        } else {
            header("Location: ../adminpanel.php?addrel=invalid");
            exit();
        }
    }
} else {
    header("Location: ../index.php?addrel=forbidden");
    exit();
}
