<?php
try {
 $mysqli = new mysqli('localhost', 'root', '', 'wa1');
 $mysqli->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
 // NEpodarilo sa pripojiť k DB!
 echo '<p class="chyba">NEpodarilo sa pripojiť do databázy!</p>';
 // debug-ovacia správa
 echo "<p>Chyba č. {$e->getCode()}: {$e->getMessage()}. Nastala v
súbore {$e->getFile()} na riadku {$e->getLine()}</p>";
 $mysqli = null;
}
?>