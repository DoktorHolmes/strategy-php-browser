<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/
include 'functions.php';
$link = connect();
$income = 2 * $unit['worker'];
$farming = 5 * pow($unit['farmer'], 0.5);
$num1 = min($weapon['sword'], $unit['warrior']);
if ($num1 == $weapon['sword']) {
    $attack = 10 * $weapon['sword'] + ($unit['warrior'] - $weapon['sword']);
} else {
    $attack = 10 * $unit['warrior'];
}
$num2 = min($weapon['shield'], $unit['defender']);
if ($num2 == $weapon['shield']) {
    $defense = 10 * $weapon['shield'] + ($unit['defender'] - $weapon['shield']);
} else {
    $defense = 10 * $unit['defender'];
}
$update_stats = mysqli_query($link, 'UPDATE `stats` SET 
                            `income`=\'' . $income . '\',`farming`=\'' . $farming . '\',
                            `attack`=\'' . $attack . '\',`defense`=\'' . $defense . '\'
                            WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
?>
