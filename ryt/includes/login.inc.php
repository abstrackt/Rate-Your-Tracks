<?php

session_start();

if (isset($_POST['submit_log'])) {

    include_once 'dbh.inc.php';

    $uid = pg_escape_string($link, $_POST['uid']);
    $pwd = pg_escape_string($link, $_POST['pwd']);

    if (empty($uid) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE nickname='$uid'";
        $result = pg_query($link, $sql);
        $check = pg_numrows($result);
        if ($check < 1) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = pg_fetch_assoc($result)) {
                $pwd_check = password_verify($pwd, $row['password']);
                if ($pwd_check == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif ($pwd_check == true) {
                    $_SESSION['u_id'] = $row['nickname'];
                    $_SESSION['u_adm'] = $row['isadmin'];
                    $_SESSION['u_nm'] = $row['name'];
                    $_SESSION['u_snm'] = $row['surname'];
                    $_SESSION['u_age'] = $row['age'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?login=forbidden");
    exit();
}
