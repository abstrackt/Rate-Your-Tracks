<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link href = "style.css" rel = "stylesheet" type = "text/css">
<body>

<?php
include_once 'header.php';
?>

<div class="signup" align=center>
  <h2>Sign up to rate tracks and explore our music database:</h2>
  <form action="includes/signup.inc.php" method="POST">
    <input type="text" name="uid" placeholder="Username"> <br><br>
    <input type="password" name="pwd" placeholder="Password"> <br><br>
    <input type="text" name="nm1" placeholder="First name (optional)"> <br><br>
    <input type="text" name="nm2" placeholder="Second name (optional)"> <br><br>
    <input type="text" name="age" placeholder="Age (optional)"> <br><br>
    <button type="submit" name="submit_sign">Register account</button>
  </form>
</div>
  

