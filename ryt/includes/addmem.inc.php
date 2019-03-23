<?php

session_start();

if (isset($_POST['submit_mem'])) {

    include_once 'dbh.inc.php';

    $aid = pg_escape_string($link, $_POST['aid']);
    $pid = pg_escape_string($link, $_POST['pid']);

    if (empty($pid) || empty($aid)) {
        header("Location: ../adminpanel.php?addmem=empty");
        exit();
    } else {
        $sql1 = "SELECT * FROM projects WHERE projectid=$pid";
        $result1 = pg_query($link, $sql1);
        $check1 = pg_numrows($result1);

        $sql2 = "SELECT * FROM artists WHERE artistid=$aid";
        $result2 = pg_query($link, $sql2);
        $check2 = pg_numrows($result2);

        if ($check1 == 1 && $check2 == 1) {
            $sql = "INSERT INTO PROJECTMEMBERS(projectid, artistid) 
                    VALUES ('$pid', '$aid');";
            pg_query($link, $sql);
            header("Location: ../adminpanel.php?addmem=success");
            exit();
        } else {
            header("Location: ../adminpanel.php?addmem=invalid");
            exit();
        }
    }
} else {
    header("Location: ../index.php?addmem=forbidden");
    exit();
}
