<?php

session_start();

if (isset($_POST['submit_art'])) {

    include_once 'dbh.inc.php';

    $anm = pg_escape_string($link, $_POST['anm']);
    $asr = pg_escape_string($link, $_POST['asr']);
    $ali = pg_escape_string($link, $_POST['ali']);
    $ins = pg_escape_string($link, $_POST['ins']);
    $brn = pg_escape_string($link, $_POST['brn']);
    $dth = pg_escape_string($link, $_POST['dth']);

    if (empty($anm) || empty($asr) || empty($ins) || empty($brn)) {
        header("Location: ../adminpanel.php?addart=empty");
        exit();
    } else {
        if (empty($ali)) $ali = '';
        $sql = '';
        if (empty($dth)) $sql = "INSERT INTO ARTISTS(name, surname, alias, instrument, born, died) 
                                VALUES ('$anm', '$asr', '$ali', '$ins', '$brn', NULL);";
        else $sql = "INSERT INTO ARTISTS(name, surname, alias, instrument, born, died) 
                     VALUES ('$anm', '$asr', '$ali', '$ins', '$brn', '$dth');";
        pg_query($link, $sql);
        header("Location: ../adminpanel.php?addart=success");
        exit();
    }
} else {
    header("Location: ../index.php?addart=forbidden");
    exit();
}
