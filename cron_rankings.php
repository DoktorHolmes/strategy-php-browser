<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

include 'functions.php';
$link = connect();
// Rankings Every 15 minutes
$get_attack = mysqli_query($link, 'SELECT `id`,`attack` FROM `stats` ORDER BY `attack` DESC') or die(mysqli_error($link));
$i = 1;
$rank = array();
while ($attack = mysqli_fetch_assoc($get_attack)) {
    $rank[$attack['id']] = $attack['attack'];
    mysqli_query($link, 'UPDATE `ranking` SET `attack`=\'' . $i . '\' WHERE `id`=\'' . $attack['id'] . '\'') or die(mysqli_error($link));
    $i++;
}
$get_defense = mysqli_query($link, 'SELECT `id`,`defense` FROM `stats` ORDER BY `defense` DESC') or die(mysqli_error($link));
$i = 1;
while ($defense = mysqli_fetch_assoc($get_defense)) {
    $rank[$defense['id']] += $defense['defense'];
    mysqli_query($link, 'UPDATE `ranking` SET `defense`=\'' . $i . '\' WHERE `id`=\'' . $defense['id'] . '\'') or die(mysqli_error($link));
    $i++;
}
asort($rank);
$rank2 = array_reverse($rank, true);
$i = 1;
foreach ($rank2 as $key => $val) {
    mysqli_query($link, 'UPDATE `ranking` SET `overall`=\'' . $i . '\' WHERE `id`=\'' . $key . '\'') or die(mysqli_error($link));
    $i++;
}
?>