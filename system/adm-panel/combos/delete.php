<?php

require_once("../../../Connection.php"); 

$id = $_POST['id'];

$pdo->query("DELETE from combos WHERE id = '$id'");

echo 'Deleted Successfully!';

?>