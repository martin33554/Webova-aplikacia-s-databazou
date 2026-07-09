<?php
session_start();
include('funkcie.php');
include('akcie.php');
include('db.php');

if(isset($_POST['odhlas'])){
	session_unset();
	session_destroy();
	header('Location: login.php');
	exit;
}
hlavicka('');
include('navigacia.php');
?>
<section>
<?php
if(isset($_POST['submit'])){
	if(!empty($_POST['username']) and !empty($_POST['heslo'])){
		$sql = 'SELECT * FROM sportcar_pouzivatelia WHERE username=?';
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("s", $_POST['username']);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result){
			if($row = $result->fetch_assoc()){
				if(password_verify($_POST['heslo'], $row['heslo'])){
					$_SESSION['meno'] = $row['meno'];
					$_SESSION['priezvisko'] = $row['priezvisko'];
					$_SESSION['uid'] = $row['uid'];
				}else{
					echo '<p class="chyba">nesprávne meno alebo heslo</p>';
				}
			}else{
				echo '<p class="chyba">nesprávne meno alebo heslo</p>';
			}		
		}
	}else{
		echo '<p class="chyba">nezadal si meno alebo heslo</p>';
	}
}
if(isset($_SESSION['meno'])){
	echo "<p>Vitaj v systéme, {$_SESSION['meno']} {$_SESSION['priezvisko']}</p>";
?>
<form method="post"> 
  <p> 
    <input name="odhlas" type="submit" id="odhlas" value="Odhlás ma"> 
  </p> 
</form> 
<?php
}
else{
?>
<form method="post">
<fieldset>
	<legend>Prihlásenie</legend>
	<label for="username">prihlasovacie meno:</label>
	<input name="username" type="text" id="username" value="" size="20" maxlength="20">
	<br>
	<label for="heslo">heslo:</label>
	<input name="heslo" type="password" id="heslo" size="20" maxlength="20">
	<br>
</fieldset>
<p><input name="submit" type="submit" id="submit" value="Prihlás"></p>
</form>
<?php
}
?>
</section>
<?php
include('pata.php');
?>
