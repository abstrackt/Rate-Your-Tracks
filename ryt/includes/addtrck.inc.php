<?php

session_start();

if (isset($_POST['submit_trck'])) {

    include_once 'dbh.inc.php';

    $rid = pg_escape_string($link, $_POST['rid']);
    $tnm = pg_escape_string($link, $_POST['tnm']);
    $tln = pg_escape_string($link, $_POST['tln']);

    if (empty($rid) || empty($tnm) || empty($tln)) {
        header("Location: ../adminpanel.php?addtrck=empty");
        exit();
    } else {
        $sql1 = "SELECT * FROM releases WHERE releaseid='$rid'";
        $result1 = pg_query($link, $sql1);
        $check1 = pg_numrows($result1);

        if ($check1 == 1) {
            $sql = "INSERT INTO TRACKS(name, playingtime, releaseid) 
                    VALUES ('$tnm', '$tln', '$rid');";
            pg_query($link, $sql);
            header("Location: ../adminpanel.php?addtrck=success");
            exit();
        } else {
            header("Location: ../adminpanel.php?addtrck=invalid");
            exit();
        }
    }
} else {
    header("Location: ../index.php?addtrck=forbidden");
    exit();
}
