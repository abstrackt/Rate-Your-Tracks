<?php

$dbserver = "localhost";
$dbuser = "akrupka";
$dbpwd = "black1234";
$dbname = "tracks";

$link = pg_connect("host=$dbserver dbname=$dbname user=$dbuser password=$dbpwd") or die('Could not connect: ' . pg_last_error());
