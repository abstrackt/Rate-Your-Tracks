<?php

session_start();

if (isset($_POST['submit_pro'])) {

    include_once 'dbh.inc.php';

    $pnm = pg_escape_string($link, $_POST['pnm']);
    $est = pg_escape_string($link, $_POST['est']);
    $dbn = pg_escape_string($link, $_POST['dbn']);
    $org = pg_escape_string($link, $_POST['org']);

    if (empty($pnm) || empty($est) || empty($org)) {
        header("Location: ../adminpanel.php?addpro=empty");
        exit();
    } else {
        $sql = '';
        if(empty($dbn)) $sql = "INSERT INTO PROJECTS(projectname, estabilished, disbanded, countryoforigin) 
                                VALUES ('$pnm', '$est', NULL, '$org');";
        else $sql = "INSERT INTO PROJECTS(projectname, estabilished, disbanded, countryoforigin) 
                     VALUES ('$pnm', '$est', '$dbn', '$org');";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?addpro=success");
        exit();
    }
} else {
    header("Location: ../index.php?addpro=forbidden");
    exit();
}
