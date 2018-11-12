<?php  

$sql = "SELECT * FROM v5_users";

$query= $pdo -> prepare($sql) ;
$query-> execute();
$tableauUsers = $query -> fetchall()


?>
