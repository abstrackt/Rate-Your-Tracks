<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link href = "style.css" rel = "stylesheet" type = "text/css">
<body>

<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';
?>

<h2 align=center>Welcome to the admin panel.</h2>

<div class="panel">
    <p>Add an artist to the database:</p>
    <form action="includes/addart.inc.php" method="POST">
        <input type="text" name="anm" placeholder="Artist's name"> <br><br>
        <input type="text" name="asr" placeholder="Artist's surname"> <br><br>
        <input type="text" name="ali" placeholder="Artist's alias"> <br><br>
        <input type="text" name="ins" placeholder="Main instrument"> <br><br>
        <input type="text" name="brn" placeholder="Date of birth (MM-DD-YYYY)"> <br><br>
        <input type="text" name="dth" placeholder="Date of death (optional)"> <br><br>
        <button type="submit" name="submit_art">Add an artist</button>
    </form>

    <p>Add a project to the database:</p>
    <form action="includes/addpro.inc.php" method="POST">
        <input type="text" name="pnm" placeholder="Project's name"> <br><br>
        <input type="text" name="est" placeholder="Estabilished (MM-DD-YYYY)"> <br><br>
        <input type="text" name="dbn" placeholder="Disbanded (MM-DD-YYYY)"> <br><br>
        <input type="text" name="org" placeholder="Country of origin"> <br><br>
        <button type="submit" name="submit_pro">Add the project</button>
    </form>

    <p>Add a member to the project:</p>
    <form action="includes/addmem.inc.php" method="POST">
        <input type="text" name="aid" placeholder="Artist's ID"> <br><br>
        <input type="text" name="pid" placeholder="Project's ID"> <br><br>
        <button type="submit" name="submit_mem">Add a member</button>
    </form>

    <p>Add a release to the database:</p>
    <form action="includes/addrel.inc.php" method="POST">
        <input type="text" name="pid" placeholder="Project's ID"> <br><br>
        <input type="text" name="rnm" placeholder="Release's name"> <br><br>
        <input type="text" name="gnr" placeholder="Genre"> <br><br>
        <input type="text" name="rld" placeholder="Release date (MM-DD-YYYY)"> <br><br>
        <input type="text" name="lid" placeholder="Label's ID"> <br><br>
        <input type="text" name="type" placeholder="(LP, EP, SINGLE)?"> <br><br>
        <button type="submit" name="submit_rel">Add the release</button>
    </form>

    <p>Add a track to a release:</p>
    <form action="includes/addtrck.inc.php" method="POST">
        <input type="text" name="rid" placeholder="Record's ID"> <br><br>
        <input type="text" name="tnm" placeholder="Track name"> <br><br>
        <input type="text" name="tln" placeholder="Track length (seconds)"> <br><br>
        <button type="submit" name="submit_trck">Add a track to the record's tracklist</button>
    </form>

    <p>Add a label to the database:</p>
    <form action="includes/addlab.inc.php" method="POST">
        <input type="text" name="lnm" placeholder="Label's name"> <br><br>
        <input type="text" name="lgn" placeholder="Main genre"> <br><br>
        <input type="text" name="est" placeholder="Estabilished (MM-DD-YYYY)"> <br><br>
        <input type="text" name="bsd" placeholder="Based in"> <br><br>
        <input type="text" name="net" placeholder="Netlabel? (Y/N)"> <br><br>
        <button type="submit" name="submit_lab">Add the label</button>
    </form>

    <p>Remove an artist from the database:</p>
    <p>This will also remove project assosciations.</p>
    <form action="includes/remart.inc.php" method="POST">
        <input type="text" name="aid" placeholder="Artist's ID"> <br><br>
        <button type="submit" name="remove_art">Remove the artist</button>
    </form>
    
    <p>Remove a project from the database:</p>
    <p>This will also remove projects and releases assosciated with the project.</p>
    <form action="includes/rempro.inc.php" method="POST">
        <input type="text" name="pid" placeholder="Project's ID"> <br><br>
        <button type="submit" name="remove_pro">Remove the project</button>
    </form>

    <p>Remove a release from the database:</p>
    <p>This will also remove tracks assosciated with the release.</p>
    <form action="includes/remrel.inc.php" method="POST">
        <input type="text" name="rid" placeholder="Release's ID"> <br><br>
        <button type="submit" name="remove_rel">Remove the release</button>
    </form>

    <p>Remove a label from the database:</p>
    <p>This will also remove releases assosciated with the label.</p>
    <form action="includes/remlab.inc.php" method="POST">
        <input type="text" name="lid" placeholder="Label's ID"> <br><br>
        <button type="submit" name="remove_lab">Remove the label</button>
    </form>
</div>
