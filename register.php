<?php
/*   ________________________________________________
    |    Converted by YAK Pro - mysql to mysqli      |
    |  GitHub: https://github.com/pk-fr/yakpro-mtm   |
    |________________________________________________|
*/

session_start();
include 'header.php';
?>
Register
<br /><br />
<?php 
if (isset($_POST['register'])) {
    $username = protect($_POST['username']);
    $password = protect($_POST['password']);
    $email = protect($_POST['email']);
    $race = protect($_POST['raceSelect']);
    if ($username == '' || $password == '' || $email == '') {
        echo 'Please supply all fields!';
    } elseif (strlen($username) > 20) {
        echo 'Username must be less than 20 characters!';
    } elseif (strlen($email) > 100) {
        echo 'E-mail must be less than 100 characters!';
    } else {
        $register1 = mysqli_query($link, "SELECT `id` FROM `user` WHERE `username`='{$username}'") or die(mysqli_error($link));
        $register2 = mysqli_query($link, "SELECT `id` FROM `user` WHERE `email`='{$email}'") or die(mysqli_error($link));
		
        if (mysqli_num_rows($register1) > 0) {
            echo 'That username is already in use!';
        } elseif (mysqli_num_rows($register2) > 0) {
            echo 'That e-mail address is already in use!';
        } else {
			$user_check = mysqli_query($link, "SELECT * FROM user WHERE username='{$username}'") or die(mysqli_error($link));
			$user = mysqli_fetch_assoc($user_check);
			$cityname = $username + "'s Stronghold";
			$uid = (int) $user['id'];
            $ins1 = mysqli_query($link, "INSERT INTO `stats` (`gold`,`attack`,`defense`,`food`,`income`,`farming`,`turns`,`builtFreeCities`,`race`) VALUES (100,10,10,100,10,11,100,0,'$race')") or die(mysqli_error($link));
			if($race == 1){
				$ins2 = mysqli_query($link, 'INSERT INTO `unit` (`worker`,`farmer`,`warrior`,`defender`) VALUES (5,5,45,0)') or die(mysqli_error($link));
			}
            $ins3 = mysqli_query($link, "INSERT INTO `user` (`username`,`password`,`email`) VALUES ('{$username}','" . md5($password) . "','{$email}')") or die(mysqli_error($link));
            $ins4 = mysqli_query($link, 'INSERT INTO `weapon` (`sword`,`shield`) VALUES (0,0)') or die(mysqli_error($link));
            $ins5 = mysqli_query($link, 'INSERT INTO `ranking` (`attack`,`defense`,`overall`) VALUES(0,0,0)') or die(mysqli_error($link));
			//$ins6 = mysqli_query($link, "INSERT INTO city(defenders, population, level, name, income, production, owner_id) VALUES (100,600,1,'$cityname',10,15,'" . $uid . "')") or die(mysqli_error($link));
            echo 'You have registered!';
        }
    }
}
?>
<br /><br />
<form action="register.php" method="POST">
Username: <input type="text" name="username"/><br />
Password: <input type="password" name="password"/><br />
E-mail: <input type="text" name="email"/><br />
<div id="RaceSelection">
Choose a race:<br/><br/>
<img src="images/races/skerran/portrait.png" width=145px height=111px id="SkerranRacePortrait">
<h4>Skerran</h2>
<font size=3>The Skerran are a proud avian race who look down on the other races, both figuratively and literally, atop their glistening citadels in the skies.  +3 Defense, +3 Income on city.  +10 garrisoned units on city.</font>
<br/>
<br/>
<br/>
<img src="images/races/ravak/portrait_ravak.png" width=145px height=111px id="RavakRacePortrait">
<h4>Ravak</h2>
<font size=3>The Ravak are a savage tribal race who crave nothing more than conquest and bloodshed.  +6 Attack, +1 Food on city, -3 Income on city, +35 warrior units at start.</font>
<br/>
<br/>
<br/>
<img src="images/races/ahni/portrait_ahni.png" width=145px height=111px id="AhniRacePortrait">
<h4>Ahni</h2>
<font size=3>The Ahni are a mysterious race of constructs whose true origin and creators are lost to the ages.  They pride themselves on their rich culture and diplomatic relations with their less sophisticated bretheren.  -4 Attack, -3 Defense, +5 Income on city & +4 Food on city</font>
</div>
<select name="raceSelect">
	<option value=0>Skerran</option>
	<option value=1>Ravak</option>
	<option value=2>Ahni</option>
</select>
<input type="submit" name="register" value="Register"/>
</form>
<?php 
include 'footer.php';
?>
