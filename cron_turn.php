<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

include 'functions.php';
$link = connect();
// Turns every 30 minutes
$get_users = mysqli_query($link, 'SELECT * FROM `stats`') or die(mysqli_error($link));
while ($user = mysqli_fetch_assoc($get_users)) {
	$get_cities = mysqli_query($link, 'SELECT `id`,`production`, `owner_id`, `income` FROM `city` WHERE `owner_id`=\''. user['id'] . '\'') or die(mysqli_error($link));
    $update = mysqli_query($link, 'UPDATE `stats` SET
                            `gold`=`gold`+\'' . $user['income'] . '\',
                            `food`=`food`+\'' . $user['farming'] . '\',
							
                            `turns`=`turns`+\'5\' WHERE `id`=\'' . $user['id'] . '\'') or die(mysqli_error($link));
	while ($city = mysqli_fetch_assoc($get_cities)) {
		$update = mysqli_query($link, 'UPDATE `stats` SET
                            `gold`=`gold`+\'' . $city['income'] . '\',
                            `food`=`food`+\'' . $city['production'] . '\',
							
                            `turns`=`turns`+\'5\' WHERE `id`=\'' . $user['id'] . '\'') or die(mysqli_error($link));
	}
}

?>
