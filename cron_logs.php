<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

include 'functions.php';
$link = connect();
// Clear Logs that are over 1 day old
mysqli_query($link, 'DELETE FROM `logs` WHERE `time`<\'' . (time() - 86400) . '\'') or die(mysqli_error($link));
?>
