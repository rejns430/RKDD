<?php
session_start(); // Sāk vai atjauno sesiju

// Izbeidz sesiju un iztukšo sesijas dati
$_SESSION = array();
session_destroy();

// Novirza lietotāju uz ielogošanās lapu vai citu vietu pēc izslēgšanas
header("Location: test.php");
exit();
?>
