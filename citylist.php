<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

session_start();
include 'header.php';
if (!isset($_SESSION['uid'])) {
    echo 'You must be logged in to view this page!';
} else {
    ?>
    <center><h2>Cities</h2></center>
    <br />
    <table cellpadding="2" cellspacing="2">
        <tr>
            <td width="50px"><b>Garrison</b></td>
            <td width="150px"><b>Controller</b></td>
            <td width="200px"><b>Name</b></td>
        </tr>
        <?php 
    $get_users = mysqli_query($link, 'SELECT `id`,`defenders`, `owner_id`, `name` FROM `city` WHERE `defenders`>\'0\' ORDER BY `defenders` DESC') or die(mysqli_error($link));
    while ($row = mysqli_fetch_assoc($get_users)) {
        echo '<tr>';
        echo '<td>' . $row['defenders'] . '</td>';
        $get_user = mysqli_query($link, 'SELECT `username` FROM `user` WHERE `id`=\'' . $row['owner_id'] . '\'') or die(mysqli_error($link));
		$get_stats = mysqli_query($link, 'SELECT * FROM `stats` WHERE `id`=\'' . $row['owner_id'] . '\'') or die(mysqli_error($link));
        $rank_name = mysqli_fetch_assoc($get_user);
		$stats = mysqli_fetch_assoc($get_stats);
        echo '<td>' . $rank_name['username'] . '</td>';
        $get_gold = mysqli_query($link, 'SELECT `name` FROM `city` WHERE `id`=\'' . $row['id'] . '\'') or die(mysqli_error($link));
        $rank_gold = mysqli_fetch_assoc($get_gold);
        echo '<td><a href="stats.php?id=' . $row['id'] . '">' . $rank_gold['name'] . '</a></td>';
        echo '</tr>';
    }
    ?>
    </table>
    <?php 
}
include 'footer.php';
?>
