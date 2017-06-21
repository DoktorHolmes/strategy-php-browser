<?php
session_start();
include("header.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
        $turns = protect($_POST['turns']);
        $id = protect($_POST['id']);
        $user_check = mysqli_query($link, 'SELECT * FROM `city` WHERE `id`=\'' . $id . '\'') or die(mysqli_error($link));
        $unit_check = mysqli_query($link, 'SELECT * FROM `unit` WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
		$user = mysqli_fetch_assoc($user_check);
		$unit = mysqli_fetch_assoc($unit_check);
        if (mysqli_num_rows($user_check) == 0) {
            output('There is no city with that ID!');
        } elseif ($turns < 1 || $turns > 10) {
            output('You must attack with 1-10 turns!');
        } elseif ($turns > $stats['turns']) {
            output('You do not have enough turns!');
        } elseif ($user['owner_id'] == $_SESSION['uid']) {
            output('You cannot attack your own city!');
        } else {
            $enemy_stats = mysqli_fetch_assoc($user_check);
            $attack_effect = $turns * 0.1 * $stats['attack'];
            $defense_effect = $user['defenders'];
			$warriors = $unit['warrior'] - floor(($defense_effect / 2)) + rand( -5, 5);
			$defenders = $enemy_stats['defenders'] - $attack_effect + rand( -5, 5);
			
            echo 'You send your warriors into battle!<br><br>';
            echo 'Your warriors dealt ' . number_format($attack_effect) . ' damage!<br>';
            echo 'The enemy\'s defenders dealt ' . number_format($defense_effect) . ' damage!<br><br>';
            if ($attack_effect > $defense_effect) {
                $ratio = ($attack_effect - $defense_effect) / $attack_effect * $turns;
                $ratio = min($ratio, 1);
                echo 'You won the siege! You have captured the city of ' . $user['name'] . '.';
                $battle1 = mysqli_query($link, 'UPDATE `city` SET `owner_id`= \'' . $_SESSION['uid'] . '\' WHERE `id`=\'' . $id . '\'') or die(mysqli_error($link));
                $stats['turns'] -= $turns;
            } else {
                echo 'You lost the siege!';
				echo ' ' . $warriors . ' of your warriors survived.';
				$battle2 = mysqli_query($link, 'UPDATE `unit` SET `warrior`= \'' . $warriors . '\' WHERE `id`=\'' . $_SESSION['uid'] . '\'') or die(mysqli_error($link));
            }
        }
}
include("footer.php");
?>