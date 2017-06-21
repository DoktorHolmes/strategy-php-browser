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
    if (isset($_POST['colonize'])) {
        $name = protect($_POST['name']);
        $defenders = protect($_POST['defenders']);
        $food_needed = 100 + 5 * $defenders;
		if($stats['builtFreeCities'] <= 2){
				output("Your first two cities are free.");
				$defenders = 65;
				}	
        else if ($stats['food'] < $food_needed) {
			
            output('You do not have enough food!');
			return "Error!";
        } 
			$population = 200;
			$level = 1;
			$name = preg_replace("/'/", "", $name);
			$income = 5;
			$production = 12;
			$uid = $_SESSION['uid'];
			if($stats['race'] == 0){
				$income = $income + 3;
				$defenders = $defenders + 10;
			}
			if($stats['race'] == 1){
				$income = $income - 3;
				$production = $production + 1;
			}
			if($stats['race'] == 2){
				$income = $income + 5;
				$production = $production + 4;
			}
			$race = $stats['race'];
            /*$update_unit = mysqli_query($link, 'UPDATE `city` SET 
                                        `defenders`=\''$city['defenders']'\',
                                        `name`=\''$city['name']'\',
                                        `population`=\''$city['population']'\',
										`owner_id`=\''. $_SESSION['uid']'\',
                                        `level`=\''$city['level']'\'') or die(mysqli_error($link));
										*/
			//$update_city = mysqli_query($link, "INSERT INTO `city` (`defenders`,`population`,`level`,`name`,`income`,`production`,`owner_id`) VALUES ('$city['defenders']', '$city['population']', '$city['level']', '$city['name']', '$city['income']', '$city['production']', '$_SESSION['uid']')") or die(mysqli_error($link));
            $update_city = mysqli_query($link, "INSERT INTO city(defenders, population, level, name, income, production, owner_id, imageid) VALUES ('$defenders', '$population', '$level', '$name', '$income', '$production', '$uid', '$race')") or die(mysqli_error($link));	
			if($stats['builtFreeCities'] > 2){
				$stats['food'] -= $food_needed;
				}	
            $update_food = mysqli_query($link, 'UPDATE `stats` SET `food`=\'' . $stats['food'] . '\' 
                                        WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
            include 'update_stats.php';
            output('You have founded a new city!');
    }
    }
    ?>
    <center><h2>Colonize a new City</h2></center>
    <br />
    Found a new city!  Your first two cities are free and come with 65 defenders each, but each subsequent city costs 100 food and 5 more per defender.
    <br /><br />
    <form action="cities.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>City Name</b></td>
            <td><b>Defenders to Garrison</b></td>
        </tr>
        <tr>
            <td><input type="text" name="name" /></td>
            <td><input type="text" name="defenders" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="colonize" value="Colonize"/></td>
        </tr>
    </table>
    </form>
    <hr />
    </form>
    <?php 
include 'footer.php';
?>
