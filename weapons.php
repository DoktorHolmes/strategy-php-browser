<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

session_start();
include 'header.php';
// Check for login
if (!isset($_SESSION['uid'])) {
    echo 'You must be logged in to view this page!';
} else {
    // User buys weapons
    if (isset($_POST['buy'])) {
        $sword = protect($_POST['sword']);
        $shield = protect($_POST['shield']);
        $gold_needed = 10 * $sword + 10 * $shield;
        if ($sword < 0 || $shield < 0) {
            output('You must buy a positive number of weapons!');
        } elseif ($stats['gold'] < $gold_needed) {
            output('You do not have enough gold!');
        } else {
            $weapon['sword'] += $sword;
            $weapon['shield'] += $shield;
            $update_weapons = mysqli_query($link, 'UPDATE `weapon` SET 
                                            `sword`=\'' . $weapon['sword'] . '\',
                                            `shield`=\'' . $weapon['shield'] . '\'
                                            WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
            $stats['gold'] -= $gold_needed;
            $update_gold = mysqli_query($link, 'UPDATE `stats` SET `gold`=\'' . $stats['gold'] . '\' 
                                        WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
            include 'update_stats.php';
            output('You have bought weapons!');
        }
    } elseif (isset($_POST['sell'])) {
        // User sells weapons
        $sword = protect($_POST['sword']);
        $shield = protect($_POST['shield']);
        $gold_gained = 8 * $sword + 8 * $shield;
        if ($sword < 0 || $shield < 0) {
            output('You must sell a positive number of weapons!');
        } elseif ($sword > $weapon['sword'] || $shield > $weapon['shield']) {
            output('You do not have that many weapons to sell!');
        } else {
            $weapon['sword'] -= $sword;
            $weapon['shield'] -= $shield;
            $update_weapons = mysqli_query($link, 'UPDATE `weapon` SET 
                                            `sword`=\'' . $weapon['sword'] . '\',
                                            `shield`=\'' . $weapon['shield'] . '\'
                                            WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
            $stats['gold'] += $gold_gained;
            $update_gold = mysqli_query($link, 'UPDATE `stats` SET `gold`=\'' . $stats['gold'] . '\' 
                                        WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
            include 'update_stats.php';
            output('You have sold weapons!');
        }
    }
    ?>
    <center><h2>Your Weapons</h2></center>
    <br />
    You can buy and sell weapons here.
    <br /><br />
    <form action="weapons.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>Weapon Type</b></td>
            <td><b>Number of Weapons</b></td>
            <td><b>Weapon Cost</b></td>
            <td><b>Buy More</b></td>
        </tr>
        <tr>
            <td>Sword</td>
            <td><?php 
    echo number_format($weapon['sword']);
    ?>
</td>
            <td>10 gold</td>
            <td><input type="text" name="sword" /></td>
        </tr>
        <tr>
            <td>Shield</td>
            <td><?php 
    echo number_format($weapon['shield']);
    ?>
</td>
            <td>10 gold</td>
            <td><input type="text" name="shield" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="buy" value="Buy"/></td>
        </tr>
    </table>
    </form>
    <hr />
    <form action="weapons.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>Weapon Type</b></td>
            <td><b>Number of Weapons</b></td>
            <td><b>Gold Gain</b></td>
            <td><b>Sell More</b></td>
        </tr>
        <tr>
            <td>Sword</td>
            <td><?php 
    echo number_format($weapon['sword']);
    ?>
</td>
            <td>8 gold</td>
            <td><input type="text" name="sword" /></td>
        </tr>
        <tr>
            <td>Shield</td>
            <td><?php 
    echo number_format($weapon['shield']);
    ?>
</td>
            <td>8 gold</td>
            <td><input type="text" name="shield" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="sell" value="Sell"/></td>
        </tr>
    </table>
    </form>
<?php 
}
include 'footer.php';
?>
