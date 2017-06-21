<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/
include 'functions.php';
$link = connect();
$stats_get = mysqli_query($link, 'SELECT * FROM `stats` WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
$stats = mysqli_fetch_assoc($stats_get);
$unit_get = mysqli_query($link, 'SELECT * FROM `unit` WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
$unit = mysqli_fetch_assoc($unit_get);
$user_get = mysqli_query($link, 'SELECT * FROM `user` WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
$user = mysqli_fetch_assoc($user_get);
$weapon_get = mysqli_query($link, 'SELECT * FROM `weapon` WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
$weapon = mysqli_fetch_assoc($weapon_get);
?>
