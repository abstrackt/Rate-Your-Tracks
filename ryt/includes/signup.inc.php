<?php

if (isset($_POST['submit_sign'])) {

    include_once 'dbh.inc.php';

    $uid = pg_escape_string($link, $_POST['uid']);
    $pwd = pg_escape_string($link, $_POST['pwd']);
    $nm1 = pg_escape_string($link, $_POST['nm1']);
    $nm2 = pg_escape_string($link, $_POST['nm2']);
    $age = pg_escape_string($link, $_POST['age']);

    if (empty($uid) || empty($pwd)) {
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        if (empty($nm1)) $nm1 = '';
        if (empty($nm2)) $nm2 = '';
        if (empty($age)) $age = NULL;
        if (!preg_match("/^[a-zA-Z]*$/", $uid) || !preg_match("/^[a-zA-Z0-9]*$/", $pwd)) {
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE nickname='$uid'";
            $result = pg_query($link, $sql);
            $check = pg_numrows($result);

            if ($check > 0) {
                header("Location: ../signup.php?signup=usertaken");
                exit();            
            } else {
                $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (nickname, password, isadmin, name, surname, age) VALUES ('$uid', '$hashed_pwd', 0, '$nm1', '$nm2', $age)";
                pg_query($link, $sql);
                header("Location: ../signup.php?signup=success");
                exit();
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}
