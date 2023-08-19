<?php

require_once("../../../Connection.php"); 

$id = $_POST['id'];

$pdo->query("UPDATE alerts SET active = 'No' WHERE id = '$id'");

echo 'Deactivated successfully!';

?>