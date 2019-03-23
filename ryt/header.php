<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link href = "style.css" rel = "stylesheet" type = "text/css">
<body>

<div class="topnav">
  <a class="active" href="index.php">Home</a>
  <a href="artists.php">Artists</a>
  <a href="find_release.php">Find a release</a>
  <a href="find_artist.php">Find an artist</a>
  <a href="find_project.php">Find a project</a>
  <a href="find_label.php">Find a label</a>
  <?php
    if(isset($_SESSION['u_id'])) {
        echo '<a href="profile.php">My profile</a>
              <form action="includes/logout.inc.php" method="POST">
                <button type="submit" name="submit_lout">Log out</button>
              </form>';
        echo "<p>".$_SESSION['u_id']."</p>";
    } else {
        echo '<a href="signup.php">Sign up</a>
              <form action="includes/login.inc.php" method="POST">
                <input type="text" name="uid" placeholder="Username">
                <input type="password" name="pwd" placeholder="Password">
                <button type="submit" name="submit_log">Log in</button>
              </form>';
    }
    if(isset($_SESSION['u_adm'])) {
        if($_SESSION['u_adm'] == 1) {
            echo '<a href="adminpanel.php">Admin panel</a>';
        }
    }
  ?>
</div class = "image">
    <img src="resources/banner.png" alt="logo" float="left" width="100%" height="100%" border="none";/>
</div>

</body>
</html>
