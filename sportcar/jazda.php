<?php
session_start();
if(!isset($_SESSION['uid'])){
    header('Location: login.php');
    exit;
}
if(!isset($_GET['id'])){
    header('Location: ponuka.php');
    exit;
}
include('funkcie.php');
include('akcie.php');
include('db.php');
if(isset($_POST['datum']) && isset($_POST['submit'])){
    $sql = "UPDATE sportcar_terminy SET uid = ? WHERE datum = ? AND idc = ? AND uid = 0";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("isi", $_SESSION['uid'], $_POST['datum'], $_GET['id']);
    $stmt->execute();
    $stmt->close();
    
    header("Location: jazda.php?id=" . $_GET['id']);
    exit;
}
hlavicka('');
include('navigacia.php');
?>
<section>
	 <form method="post">
			<fieldset>
			<legend>Rezervácia</legend>
			Objednávateľ: <strong><?php echo $_SESSION['meno'] . ' ' . $_SESSION['priezvisko']; ?></strong><br>
			<label for="datum">dátum testovania:</label>
			<select id="datum" name="datum">
				<option value = ''>-</option>
				<?php
				$sql = "SELECT datum FROM sportcar_terminy WHERE idc=? and uid = 0 and datum > NOW()";	
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("i", $_GET['id']);
				$stmt->execute();
				$result = $stmt->get_result();
				while($row = $result->fetch_assoc()){
					echo "<option value='{$row["datum"]}'>{$row['datum']}</option>";
				}
				$stmt->close();
				?>
			</select>
			<br>
			</fieldset>	
			<p><input name="submit" type="submit" id="submit" value="Rezervuj"></p>
   </form>

</section>
<?php
include('pata.php');
?>
