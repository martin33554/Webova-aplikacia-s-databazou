<?php
session_start();
include('funkcie.php');
hlavicka('');
include('navigacia.php');
include('akcie.php');
include('db.php');
?>
<section>
<table>
<tr><th>auto</th><th>výkon</th><th>max. rýchlosť</th><th>foto</th><th>hodnotenie</th><th>&nbsp;</th><th>&nbsp;</th></tr>
<?php
$sql = 'SELECT t1.*, AVG(body) AS priemer FROM sportcar_auta t1 LEFT JOIN sportcar_hodnotenie t2 ON t1.idc = t2.idc GROUP BY t1.idc ORDER BY nazov ASC';
$result = $mysqli->query($sql);
if($result  and $result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo "<tr><td>{$row['nazov']}</td><td>{$row['vykon']}</td><td>{$row['rychlost']}</td><td><img src='obrazky/{$row["idc"]}.jpg' alt='auto'></td><td>{$row['priemer']}</td>";
		if(isset($_SESSION['meno'])){
			echo "<td><a href = 'hodnotenie.php?id={$row["idc"]}'>hodnot</a></td><td><a href = 'jazda.php?id={$row["idc"]}'>rezervuj</a></td></tr>";
		}
		else{
			echo "<td></td><td></td></tr>";
		}
	}
	?>
	</table>
	<?php
}else{
	?>
	</table>
	<?php
	echo '<p class="chyba">ziadne auto</p>';
}
?>
</section>
<?php
include('pata.php');
?>
