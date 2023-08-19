<?php

require_once("../../../Connection.php"); 

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM alerts where active = 'Yes' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);



$pdo->query("UPDATE alerts SET active = 'Yes' WHERE id = '$id'");

echo 'Activated successfully!';

?>