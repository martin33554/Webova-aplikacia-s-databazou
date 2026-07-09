<?php
session_start();
include('funkcie.php');
include('akcie.php');
include('db.php');

if(!isset($_SESSION['uid'])){
    header('Location: login.php');
    exit;
}
if(!isset($_GET['id'])){
    header('Location: ponuka.php');
    exit;
}
$idc = (int)$_GET['id'];

if(isset($_POST['zrus'])){
	$sql = 'DELETE FROM sportcar_hodnotenie WHERE uid=? AND idc=?';
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param("ii", $_SESSION['uid'], $idc);
	$stmt->execute();
	$stmt->close();
	header('Location: hodnotenie.php?id=' . $idc);
    exit;
}

if(isset($_POST['hodnot']) and isset($_POST['body']) and $_POST['body'] != '-'){
    $sql = 'SELECT body FROM sportcar_hodnotenie WHERE idc = ? AND uid = ?';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $idc, $_SESSION['uid']);
    $stmt->execute();
    $existuje = $stmt->get_result()->num_rows > 0;
    $stmt->close();

    if($existuje){
        $sql = "UPDATE sportcar_hodnotenie SET body = ? WHERE idc = ? AND uid = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iii", $_POST['body'], $idc, $_SESSION['uid']);
    } else {
        $sql = "INSERT INTO sportcar_hodnotenie (idc, uid, body) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("iii", $idc, $_SESSION['uid'], $_POST['body']);
    }
    
    $stmt->execute();
    $stmt->close();
    header('Location: hodnotenie.php?id=' . $idc);
    exit;
}

hlavicka('');
include('navigacia.php');
?>
<section>
<?php
$sql = 'SELECT t1.nazov, t2.body FROM sportcar_auta t1 LEFT JOIN sportcar_hodnotenie t2 ON t1.idc=t2.idc AND t2.uid = ? WHERE t1.idc = ?';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii", $_SESSION['uid'], $idc);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()){
	$auto = $row['nazov'];
	$body = (int)$row['body'];
$stmt->close();
?>
	 <form method="post">
			<fieldset>
			<legend>Hodnotíte</legend>
			testovacie auto: <strong><?php echo $auto; ?></strong><br>
			<label for="body">hodnotenie:</label>
			<select id="body" name="body">
				<option value="-">-</option>
<?php
vypis_select(1, 5, $body);
?>
			</select>
			<br>
			</fieldset>	
			<p><input name="hodnot" type="submit" id="hodnot" value="Pridaj / uprav hodnotenie"></p>
<?php
if($body > 0){
?>
   </form>
	 <form method="post">
			<p><input name="zrus" type="submit" id="zrus" value="Vymaž hodnotenie"></p>
   </form>
<?php
} else {
    echo "</form>"; 
}
}
?>
</section>
<?php
include('pata.php');
?>