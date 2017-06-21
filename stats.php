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
    if (!isset($_GET['id'])) {
        output('You have visited this page incorrectly!');
    } else {
        $id = protect($_GET['id']);
		$imageid = 0;
        $user_check = mysqli_query($link, 'SELECT * FROM `city` WHERE `id`=\'' . $id . '\'') or die(mysqli_error($link));
        if (mysqli_num_rows($user_check) == 0) {
            output('There is no city with that ID!');
        } else {
            $s_user = mysqli_fetch_assoc($user_check);
			$stats_check = mysqli_query($link, 'SELECT * FROM stats WHERE `id`=\'' . $s_user['owner_id'] . '\'') or die(mysqli_error($link));
			$s_stats = mysqli_fetch_assoc($stats_check);
			if($s_user['imageid'] == 0){
				$imageid = 'skerran_city';
			}
			else if($s_user['imageid'] == 1){
				$imageid = 'ravak_city';
			}
			else if($s_user['imageid'] == 2){
				$imageid = 'ahni_city';
			}
			else{
				$imageid = 0;
			}
			
            ?>
            <center><h2><?php echo $s_user['name'];?></h2></center>
            <br />
            <br /><center><img id="cityImage" width=350 height=205 src="images/cities/<?php echo $imageid ?>.jpg"></center><br />
            <b>
</b> 
            <br />
			<b>Garrisoned Defenders: <?php 
            echo number_format($s_user['defenders']);
            ?>
</b>
            <br />
            <b>Income: <?php 
            echo number_format($s_user['income']);
            ?>
</b>
            <br />
			<b>Production: <?php 
            echo number_format($s_user['production']);
            ?>
</b>
            <br />
			<b>Population: <?php 
            echo number_format($s_user['population']);
            ?>
</b>
            <br />
            <br />
            <form action="battle.php" method="post">
            <br />
            <?php 
            if (mysqli_num_rows($attacks_check) < 5) {
                ?>
            Number of Turns (1-10): <input type="text" name="turns" /> 
            <input type="submit" name="capture" value="Capture the city!" />
            <input type="hidden" name="id" value="<?php 
                echo $id;
                ?>
"/>
            <?php 
            }
            ?>
            </form>
            <?php 
        }
    }
}
include 'footer.php';
?>
