<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

include 'functions.php';
$link = connect();
?>
<html>
<head>
<title>World's End - A Strategy Game</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="header">World's End - Alpha</div>
<div id="container">
<div id="navigation"><div id="nav_div">
<?php 
if (isset($_SESSION['uid'])) {
    include 'safe.php';
    ?>
    » <a href="main.php">Your Stats</a><br /><br />
    » <a href="citylist.php">Cities</a><br /><br />
    » <a href="cities.php">Colonize</a><br /><br />
    » <a href="units.php">Your Units</a><br /><br />
    » <a href="weapons.php">Your Weapons</a><br /><br />
    » <a href="logout.php">Logout</a>
    <?php 
} else {
    ?>
    <form action="login.php" method="post">
    Username: <input type="text" name="username"/><br />
    Password: <input type="password" name="password"/><br />
    <input type="submit" name="login" value="login"/>
    </form>
    » <a href="register.php">Register</a>
    <?php 
}
?>
</div></div>
<div id="content"><div id="con_div">
