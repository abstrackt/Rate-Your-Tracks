<?php

session_start();

if (isset($_POST['submit_lab'])) {

    include_once 'dbh.inc.php';

    $lnm = pg_escape_string($link, $_POST['lnm']);
    $lgn = pg_escape_string($link, $_POST['lgn']);
    $est = pg_escape_string($link, $_POST['est']);
    $bsd = pg_escape_string($link, $_POST['bsd']);
    $net = pg_escape_string($link, $_POST['net']);

    if (empty($lnm) || empty($lgn) || empty($est) || empty($bsd) || empty($net)) {
        header("Location: ../adminpanel.php?addlab=empty");
        exit();
    } else {
        $sql = "INSERT INTO LABELS(name, genre, estabilished, basedin, isnetlabel) 
                VALUES ('$lnm', '$lgn', '$est', '$bsd', '$net');";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?addlab=success");
        exit();
    }
} else {
    header("Location: ../index.php?addlab=forbidden");
    exit();
}
