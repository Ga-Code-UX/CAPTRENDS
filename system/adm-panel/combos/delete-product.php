<?php

require_once("../../../Connection.php"); 

$id = $_POST['product_id'];

$pdo->query("DELETE from products_combo WHERE id = '$id'");

echo 'Successfully deleted!';

?>